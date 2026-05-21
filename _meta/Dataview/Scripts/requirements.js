const requires = dv.current().requires;

if (!requires) return;

// -------------------------
// NORMALIZE
// -------------------------

function normalize(req) {
    if (req == null) return null;

    if (typeof req === "object" && req.link) {
        const link = req.link;

        return {
            path: link.path?.trim?.() ?? null,
            display: link.display ?? null,
            raw: null
        };
    }

    return {
        path: null,
        display: null,
        raw: req.toString()
    };
}

// -------------------------
// INLINE RENDER (STRING SAFE)
// -------------------------

function renderInline(str, container) {
    if (!str) return;

    let last = 0;
    const regex = /\[\[(.*?)(?:\|(.*?))?\]\]/g;
    let m;

    while ((m = regex.exec(str)) !== null) {

        const before = str.slice(last, m.index);
        if (before) container.appendText(before);

        const path = m[1]?.trim();
        const display =
            m[2]?.trim() ??
            path.split("/").pop().replace(".md", "");

        const page = dv.page(path);

        if (page) {
            const a = container.createEl("a", {
                text: display,
                cls: "internal-link"
            });

            a.setAttribute("href", page.file.path);
        } else {
            container.appendText(display);
        }

        last = regex.lastIndex;
    }

    const after = str.slice(last);
    if (after) container.appendText(after);
}

// -------------------------
// RENDER ITEM
// -------------------------

function renderItem(item, container) {
    const n = normalize(item);

    if (n.path) {
        const page = dv.page(n.path);

        const name =
            n.display ??
            n.path.split("/").pop().replace(".md", "");

        if (page) {
            const a = container.createEl("a", {
                text: name,
                cls: "internal-link"
            });

            a.setAttribute("href", page.file.path);
        } else {
            container.appendText(name);
        }

        return;
    }

    renderInline(n.raw, container);
}

// -------------------------
// FLATTEN ANY
// -------------------------

function flatten(reqs) {
    const out = [];

    for (const r of reqs ?? []) {
        if (r?.any) {
            out.push({ type: "any", items: r.any });
        } else {
            out.push(r);
        }
    }

    return out;
}

// -------------------------
// BUILD UI (IMPORTANT CHANGE)
// -------------------------

const container = dv.container.createDiv();
container.createEl("strong", { text: "Requirements: " });

const flat = flatten(requires);

let first = true;

for (const req of flat) {

    if (!first) container.appendText("; ");
    first = false;

    if (req.type === "any") {
        container.appendText("(");

        let i = 0;
        for (const item of req.items) {
            if (i++ > 0) container.appendText(" or ");
            renderItem(item, container);
        }

        container.appendText(")");
        continue;
    }

    renderItem(req, container);
}