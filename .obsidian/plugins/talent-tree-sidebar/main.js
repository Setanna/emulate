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
        this.totalXPCache = new Map();
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

    // Resolve ANY Obsidian link (including full paths + aliases) -> TFile
    resolveFile(v, sourcePath) {

        if (!v) return null;

        if (typeof v === "object") {
            if (v.path) v = v.path;
            else v = String(v);
        }

        if (typeof v !== "string") return null;

        const cleaned = v
            .replace(/\[\[|\]\]/g, "")
            .split("|")[0]
            .trim();

        return this.app.metadataCache.getFirstLinkpathDest(
            cleaned,
            sourcePath
        );
    }

    getFolder(file) {
        return file.path.split('/').slice(0, -1).join('/');
    }

    getNodeId(file) {
        return file.path;
    }

    getXP(file) {

        const fm = this.app.metadataCache
            .getFileCache(file)?.frontmatter;

        if (!fm) return 0;

        // Supports:
        // xp: 12
        // XP: 12
        // xp: "12 XP"
        const rawXP = fm.xp ?? fm.XP ?? 0;

        if (typeof rawXP === 'number') {
            return rawXP;
        }

        const match = String(rawXP).match(/\d+/);

        return match
            ? parseInt(match[0], 10)
            : 0;
    }

    getTotalXP(file, requiresMap, fileByPath, visited = new Set()) {

        if (!file) return 0;

        // Cached
        if (this.totalXPCache.has(file.path)) {
            return this.totalXPCache.get(file.path);
        }

        // Circular protection
        if (visited.has(file.path)) {
            return 0;
        }

        visited.add(file.path);

        let total = this.getXP(file);

        const reqs = requiresMap.get(file.path);

        if (reqs) {

            // Normal requirements
            for (const reqPath of reqs.normal) {

                const reqFile = fileByPath.get(reqPath);

                if (reqFile) {
                    total += this.getTotalXP(
                        reqFile,
                        requiresMap,
                        fileByPath,
                        visited
                    );
                }
            }

            // OR groups
            // Uses cheapest branch
            for (const group of reqs.orGroups) {

                let cheapest = Infinity;

                for (const optionPath of group) {

                    const optionFile = fileByPath.get(optionPath);

                    if (!optionFile) continue;

                    const optionCost = this.getTotalXP(
                        optionFile,
                        requiresMap,
                        fileByPath,
                        new Set(visited)
                    );

                    cheapest = Math.min(
                        cheapest,
                        optionCost
                    );
                }

                if (cheapest !== Infinity) {
                    total += cheapest;
                }
            }
        }

        this.totalXPCache.set(file.path, total);

        return total;
    }

    getLabel(file, requiresMap, fileByPath) {

        const xp = this.getXP(file);
        const totalXP = this.getTotalXP(
            file,
            requiresMap,
            fileByPath
        );

        return `${file.basename}<br/>${xp} / ${totalXP} XP`;
    }

    async updateTree() {

        if (this._rendering) return;

        this._rendering = true;

        try {

            // Reset cache every render
            this.totalXPCache.clear();

            const container = this.containerEl.children[1];

            container.empty();

            const activeFile = this.app.workspace.getActiveFile();

            if (!activeFile) return;

            const allFiles = this.app.vault.getMarkdownFiles();

            const fileByPath = new Map(
                allFiles.map(f => [f.path, f])
            );

            const startFolder = this.getFolder(activeFile);

            const inScopeFolder = (file) => {

                const folder = this.getFolder(file);

                return (
                    folder === startFolder ||
                    folder.startsWith(startFolder + "/")
                );
            };

            // -----------------------------
            // GRAPH STRUCTURES
            // -----------------------------
            const requiresMap = new Map();
            const reverseMap = new Map();

            const addReverse = (
                reqFile,
                dependentPath,
                isOr
            ) => {

                if (!reqFile) return;

                const key = reqFile.path;

                if (!reverseMap.has(key)) {
                    reverseMap.set(key, []);
                }

                reverseMap.get(key).push({
                    node: dependentPath,
                    isOr
                });
            };

            for (const f of allFiles) {

                const fm = this.app.metadataCache
                    .getFileCache(f)?.frontmatter;

                if (!fm?.requires) continue;

                const raw = Array.isArray(fm.requires)
                    ? fm.requires
                    : [fm.requires];

                const normal = [];
                const orGroups = [];

                for (const item of raw) {

                    // OR group
                    if (
                        item &&
                        typeof item === "object" &&
                        item.any
                    ) {

                        const group = item.any
                            .map(x => this.resolveFile(x, f.path))
                            .filter(Boolean)
                            .map(x => x.path);

                        if (group.length) {

                            orGroups.push(group);

                            for (const gPath of group) {

                                addReverse(
                                    fileByPath.get(gPath),
                                    f.path,
                                    true
                                );
                            }
                        }

                    } else {

                        const resolved = this.resolveFile(
                            item,
                            f.path
                        );

                        if (!resolved) continue;

                        normal.push(resolved.path);

                        addReverse(
                            resolved,
                            f.path,
                            false
                        );
                    }
                }

                requiresMap.set(f.path, {
                    normal,
                    orGroups
                });
            }

            // -----------------------------
            // WALK GRAPH
            // -----------------------------
            const visited = new Set();
            const edges = new Set();

            const walk = (nodePath) => {

                if (visited.has(nodePath)) return;

                visited.add(nodePath);

                const reqs = requiresMap.get(nodePath);

                if (reqs) {

                    for (const reqPath of reqs.normal) {

                        const edge =
                            `${reqPath}-->${nodePath}`;

                        if (!edges.has(edge)) {

                            edges.add(edge);

                            walk(reqPath);
                        }
                    }

                    for (const group of reqs.orGroups) {

                        for (const optionPath of group) {

                            const edge =
                                `OR:${optionPath}-->${nodePath}`;

                            if (!edges.has(edge)) {

                                edges.add(edge);

                                walk(optionPath);
                            }
                        }
                    }
                }

                const children =
                    reverseMap.get(nodePath) || [];

                for (const child of children) {

                    if (
                        !inScopeFolder(
                            fileByPath.get(child.node)
                        )
                    ) continue;

                    const edge = child.isOr
                        ? `OR:${nodePath}-->${child.node}`
                        : `${nodePath}-->${child.node}`;

                    if (!edges.has(edge)) {

                        edges.add(edge);

                        walk(child.node);
                    }
                }
            };

            walk(activeFile.path);

            // -----------------------------
            // MERMAID OUTPUT
            // -----------------------------
            let mermaid = "```mermaid\n";

            mermaid += "graph TD\n";

            for (const e of edges) {

                const isOr = e.startsWith("OR:");

                const [fromPath, toPath] = e
                    .replace("OR:", "")
                    .split("-->");

                const fromFile =
                    fileByPath.get(fromPath);

                const toFile =
                    fileByPath.get(toPath);

                if (!fromFile || !toFile) continue;

                const fromId = fromFile.path
                    .replace(/\W/g, "_");

                const toId = toFile.path
                    .replace(/\W/g, "_");

                const fromLabel = this.getLabel(
                    fromFile,
                    requiresMap,
                    fileByPath
                );

                const toLabel = this.getLabel(
                    toFile,
                    requiresMap,
                    fileByPath
                );

                if (isOr) {

                    mermaid +=
`${fromId}["${fromLabel}"] -.->|OR| ${toId}["${toLabel}"]\n`;

                } else {

                    mermaid +=
`${fromId}["${fromLabel}"] --> ${toId}["${toLabel}"]\n`;
                }
            }

            mermaid += "```";

            await MarkdownRenderer.renderMarkdown(
                mermaid,
                container,
                activeFile.path,
                this
            );

        } finally {

            this._rendering = false;
        }
    }
}