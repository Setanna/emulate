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

    normalize(v) {

        if (!v) return null;

        if (typeof v !== "string") {
            v = v.toString();
        }

        return v
            .replace(/\[\[|\]\]/g, "")
            .split("|")
            .pop()
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

            if (!file) {
                container.setText('No active talent selected');
                return;
            }

            const allFiles = this.app.vault.getMarkdownFiles();

            const fileSet = new Set(allFiles.map(f => f.basename));

            const currentTalent = file.basename;
            const currentFolder = this.getFolder(file);

            const folderNames = new Set(
                allFiles
                    .filter(f => this.getFolder(f) === currentFolder)
                    .map(f => f.basename)
            );

            // -------------------------
            // TALENT + OR MAP
            // -------------------------
            const talentMap = new Map();
            const orMap = new Map();

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

                        if (group.length) orGroups.push(group);

                    } else {

                        const n = this.normalize(item);

                        if (fileSet.has(n)) {
                            normal.push(n);
                        }
                    }
                }

                talentMap.set(f.basename, normal);

                if (orGroups.length) {
                    orMap.set(f.basename, orGroups);
                }
            }

            // -------------------------
            // GRAPH BUILD
            // -------------------------
            const visited = new Set();
            const edges = new Set();

            const walk = (node) => {

                if (!fileSet.has(node)) return;
                if (visited.has(node)) return;

                visited.add(node);

                const reqs = talentMap.get(node) || [];

                // -------------------------
                // NORMAL EDGES (solid)
                // -------------------------
                for (const req of reqs) {

                    if (!fileSet.has(req)) continue;

                    edges.add(`${req}-->${node}`);
                    walk(req);
                }

                // -------------------------
                // OR EDGES (dotted + NOW TRAVERSED)
                // -------------------------
                const orGroups = orMap.get(node) || [];

                for (const group of orGroups) {

                    for (const option of group) {

                        if (!fileSet.has(option)) continue;

                        // dotted edge
                        edges.add(`OR:${option}-->${node}`);

                        // 🔥 IMPORTANT: now we ALSO traverse OR nodes
                        walk(option);
                    }
                }

                // -------------------------
                // CHILD LINKS
                // -------------------------
                for (const [talent, parents] of talentMap.entries()) {

                    if (!folderNames.has(talent)) continue;

                    if (parents.includes(node)) {
                        edges.add(`${node}-->${talent}`);
                        walk(talent);
                    }
                }
            };

            walk(currentTalent);

            // -------------------------
            // MERMAID OUTPUT
            // -------------------------
            let mermaid = "```mermaid\n";
            mermaid += "%%{init: {'flowchart': {'curve': 'basis'}}}%%\n";
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