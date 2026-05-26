const requires = dv.current().requires;

// Accept BOTH naming styles
const reactionTriggers =
    dv.current().reaction_triggers ??
    dv.current().reaction_trigger;

const freeActionTriggers =
    dv.current().free_action_triggers ??
    dv.current().free_action_trigger;

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
// INLINE RENDER (FIXED FOR #HEADERS)
// -------------------------

function renderInline(str, container) {

    if (!str) return;

    let last = 0;

    // FIX: allow optional #section inside links
    const regex = /\[\[([^|\]]+?)(#[^|\]]+)?(?:\|([^\]]+))?\]\]/g;

    let m;

    while ((m = regex.exec(str)) !== null) {

        const before = str.slice(last, m.index);
        if (before) container.appendText(before);

        const pagePath = (m[1] ?? "").trim();
        const section = (m[2] ?? "").trim(); // includes #
        const rawDisplay = m[3]?.trim();

        const fullPath = pagePath + section;

        const display =
            rawDisplay ??
            pagePath.split("/").pop().replace(".md", "");

        const page = dv.page(pagePath);

        if (page) {

            const a = container.createEl("a", {
                text: display,
                cls: "internal-link"
            });

            // IMPORTANT:
            // Obsidian internal links want full "Page#Section"
            a.setAttribute("href", pagePath + section);

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

    if (!n) return;

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

            out.push({
                type: "any",
                items: r.any
            });

        } else {

            out.push(r);
        }
    }

    return out;
}

// -------------------------
// REQUIREMENTS
// -------------------------

function renderRequirements() {

    if (!requires) return;

    const container = dv.container.createDiv();

    container.createEl("strong", {
        text: "Requirements: "
    });

    const flat = flatten(requires);

    let first = true;

    for (const req of flat) {

        if (!first) container.appendText("; ");

        first = false;

        if (req.type === "any") {

            container.appendText("(");

            req.items.forEach((item, index) => {

                if (index > 0) {

                    if (index === req.items.length - 1) {
                        container.appendText(" or ");
                    } else {
                        container.appendText(", ");
                    }
                }

                renderItem(item, container);
            });

            container.appendText(")");

            continue;
        }

        renderItem(req, container);
    }
}

// -------------------------
// TRIGGERS
// -------------------------

function renderTriggers(label, triggers) {

    if (!triggers || !Array.isArray(triggers)) return;

    for (const trigger of triggers) {

        const wrapper = dv.container.createDiv();

        const p = wrapper.createEl("p");

        p.createEl("strong", {
            text: `${label}: `
        });

        renderInline(trigger.text, p);

        const hasItems =
            trigger.items &&
            Array.isArray(trigger.items) &&
            trigger.items.length > 0;

        if (!hasItems) {
            p.appendText(".");
            continue;
        }

        const ul = wrapper.createEl("ul");

        for (const item of trigger.items) {

            const li = ul.createEl("li");

            renderInline(item, li);
        }
    }
}

// -------------------------
// BUILD UI
// -------------------------

renderRequirements();

renderTriggers("Reaction Trigger", reactionTriggers);

renderTriggers("Free Action Trigger", freeActionTriggers);