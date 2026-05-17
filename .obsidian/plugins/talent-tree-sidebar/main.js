const { Plugin, ItemView, MarkdownRenderer } = require('obsidian');

const VIEW_TYPE_TALENT_TREE = 'talent-tree-view';

module.exports = class TalentTreePlugin extends Plugin {

    async onload() {

        this.registerView(
            VIEW_TYPE_TALENT_TREE,
            (leaf) => new TalentTreeView(leaf, this.app)
        );

        this.addRibbonIcon('git-branch', 'Talent Tree', async () => {
            await this.activateView();
        });

        this.registerEvent(
            this.app.workspace.on('active-leaf-change', async () => {
                const leaves = this.app.workspace.getLeavesOfType(VIEW_TYPE_TALENT_TREE);

                for (const leaf of leaves) {
                    if (leaf.view instanceof TalentTreeView) {
                        await leaf.view.updateTree();
                    }
                }
            })
        );
    }

    async activateView() {

        let leaf = this.app.workspace.getLeavesOfType(VIEW_TYPE_TALENT_TREE)[0];

        if (!leaf) {
            leaf = this.app.workspace.getRightLeaf(false);

            await leaf.setViewState({
                type: VIEW_TYPE_TALENT_TREE,
                active: true
            });
        }

        this.app.workspace.revealLeaf(leaf);
    }
};


class TalentTreeView extends ItemView {

    constructor(leaf, app) {
        super(leaf);
        this.app = app;
        this._rendering = false;
    }

    getViewType() {
        return VIEW_TYPE_TALENT_TREE;
    }

    getDisplayText() {
        return 'Talent Tree';
    }

    async onOpen() {
        await this.updateTree();
    }

    // ✅ FIXED: properly handles [[Link | Alias]] and Obsidian objects
    normalize(v) {
        if (!v) return null;

        // Handle Obsidian link objects safely
        if (typeof v === "object") {
            if (v.path) {
                v = v.path;
            } else {
                v = String(v);
            }
        }

        if (typeof v !== "string") return null;

        return v
            // remove wiki brackets
            .replace(/\[\[|\]\]/g, "")
            // take LEFT side of alias (real filename)
            .split("|")[0]
            .trim();
    }

    getFolder(file) {
        return file.path.split('/').slice(0, -1).join('/');
    }

    async updateTree() {

        if (this._rendering) return;
        this._rendering = true;

        try {

            const container = this.containerEl.children[1];
            container.empty();

            const file = this.app.workspace.getActiveFile();
            if (!file) return;

            const allFiles = this.app.vault.getMarkdownFiles();
            const fileSet = new Set(allFiles.map(f => f.basename));

            const startFolder = this.getFolder(file);

            // Allow same folder + subfolders
            const isFolderMatch = (name) => {

                const f = allFiles.find(x => x.basename === name);
                if (!f) return false;

                const targetFolder = this.getFolder(f);

                return (
                    targetFolder === startFolder ||
                    targetFolder.startsWith(startFolder + "/")
                );
            };

            // ---------------------------------------------------
            // GLOBAL GRAPH
            // ---------------------------------------------------

            const talentRequires = new Map();
            const reverseMap = new Map();

            const addReverse = (req, dependent, isOr = false) => {

                const n = this.normalize(req);
                if (!n || !fileSet.has(n)) return;

                if (!reverseMap.has(n)) {
                    reverseMap.set(n, []);
                }

                reverseMap.get(n).push({ node: dependent, isOr });
            };

            for (const f of allFiles) {

                const fm = this.app.metadataCache.getFileCache(f)?.frontmatter;
                if (!fm?.requires) continue;

                const raw = Array.isArray(fm.requires)
                    ? fm.requires
                    : [fm.requires];

                const normal = [];
                const orGroups = [];

                for (const item of raw) {

                    if (item && typeof item === "object" && item.any) {

                        const group = item.any
                            .map(x => this.normalize(x))
                            .filter(x => fileSet.has(x));

                        if (group.length) {

                            orGroups.push(group);

                            for (const g of group) {
                                addReverse(g, f.basename, true);
                            }
                        }

                    } else {

                        const n = this.normalize(item);

                        if (fileSet.has(n)) {
                            normal.push(n);
                            addReverse(n, f.basename, false);
                        }
                    }
                }

                talentRequires.set(f.basename, { normal, orGroups });
            }

            // ---------------------------------------------------
            // GRAPH WALK
            // ---------------------------------------------------

            const visited = new Set();
            const edges = new Set();

            const walk = (node) => {

                if (visited.has(node)) return;
                visited.add(node);

                const reqs = talentRequires.get(node);

                if (reqs) {

                    for (const req of reqs.normal) {

                        if (!fileSet.has(req)) continue;

                        const edge = `${req}-->${node}`;

                        if (!edges.has(edge)) {
                            edges.add(edge);
                            walk(req);
                        }
                    }

                    for (const group of reqs.orGroups) {

                        for (const option of group) {

                            if (!fileSet.has(option)) continue;

                            const edge = `OR:${option}-->${node}`;

                            if (!edges.has(edge)) {
                                edges.add(edge);
                                walk(option);
                            }
                        }
                    }
                }

                const children = reverseMap.get(node) || [];

                for (const child of children) {

                    if (!isFolderMatch(child.node)) continue;

                    const edge = child.isOr
                        ? `OR:${node}-->${child.node}`
                        : `${node}-->${child.node}`;

                    if (!edges.has(edge)) {
                        edges.add(edge);
                        walk(child.node);
                    }
                }
            };

            walk(file.basename);

            // ---------------------------------------------------
            // MERMAID OUTPUT
            // ---------------------------------------------------

            let mermaid = "```mermaid\n";
            mermaid += "graph TD\n";

            for (const e of edges) {

                const isOr = e.startsWith("OR:");
                const [from, to] = e.replace("OR:", "").split("-->");

                const safeFrom = from.replace(/\s+/g, '_');
                const safeTo = to.replace(/\s+/g, '_');

                if (isOr) {
                    mermaid += `${safeFrom}["${from}"] -.->|OR| ${safeTo}["${to}"]\n`;
                } else {
                    mermaid += `${safeFrom}["${from}"] --> ${safeTo}["${to}"]\n`;
                }
            }

            mermaid += "```";

            await MarkdownRenderer.renderMarkdown(
                mermaid,
                container,
                file.path,
                this
            );

        } finally {
            this._rendering = false;
        }
    }
};