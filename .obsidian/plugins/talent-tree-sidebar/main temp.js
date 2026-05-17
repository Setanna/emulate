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

    normalize(value) {

        if (!value) return [];

        if (Array.isArray(value)) {
            return value.map(v => this.normalizeSingle(v));
        }

        return [this.normalizeSingle(value)];
    }

    normalizeSingle(v) {

        if (typeof v === "string") {
            return v.replace(/\[\[|\]\]/g, '').trim();
        }

        if (v?.path) return v.path;

        return String(v).replace(/\[\[|\]\]/g, '').trim();
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

            const currentTalent = file.basename;
            const currentFolder = this.getFolder(file);

            // -------------------------
            // FILTER: ONLY SAME FOLDER TALENTS
            // -------------------------
            const folderFiles = allFiles.filter(f =>
                this.getFolder(f) === currentFolder
            );

            const folderNames = new Set(folderFiles.map(f => f.basename));

            // -------------------------
            // BUILD TALENT MAP (GLOBAL requires)
            // -------------------------
            const talentMap = new Map();

            for (const f of allFiles) {

                const fm = this.app.metadataCache.getFileCache(f)?.frontmatter;
                if (!fm?.requires) continue;

                const reqs = this.normalize(fm.requires);

                talentMap.set(f.basename, reqs);
            }

            // -------------------------
            // GRAPH BUILD (FOLDER SCOPED)
            // -------------------------
            const visited = new Set();
            const edges = new Set();

            const walk = (node) => {

                if (visited.has(node)) return;
                visited.add(node);

                const reqs = talentMap.get(node) || [];

                // parent links (ALLOWED ANYWHERE)
                for (const req of reqs) {

                    edges.add(`${req}-->${node}`);
                    walk(req);
                }

                // child links (ONLY IF IN SAME FOLDER)
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

                const [from, to] = e.split("-->");

                const safeFrom = from.replace(/\s+/g, '_');
                const safeTo = to.replace(/\s+/g, '_');

                mermaid += `${safeFrom}["${from}"] --> ${safeTo}["${to}"]\n`;
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