const requires = dv.current().requires;

if (!requires) return;

// -------------------------
// HELPERS
// -------------------------
function normalizeName(req) {
    if (!req) return null;
    return req.toString()
        .replace(/\[\[|\]\]/g, "")
        .split("|")
        .pop()
        .trim();
}

function normalizeLink(req) {
    if (!req) return null;
    return req.toString()
        .replace(/\[\[|\]\]/g, "")
        .split("|")[0]
        .trim();
}

// -------------------------
// FLATTEN REQUIREMENTS (supports "any")
// -------------------------
function flatten(reqs) {

    const result = [];

    for (const r of reqs) {

        // handle: { any: [...] }
        if (r && typeof r === "object" && r.any) {
            result.push({
                type: "any",
                items: r.any
            });
        } else {
            result.push(r);
        }
    }

    return result;
}

// -------------------------
// BUILD ELEMENTS
// -------------------------
const elements = [];

const flat = flatten(requires);

for (const req of flat) {

    // -------------------------
    // ANY GROUP (OR LOGIC)
    // -------------------------
    if (req.type === "any") {

        const group = req.items.map(item => {

            const name = normalizeName(item);
            const link = normalizeLink(item);

            if (!link) return name;

            const page = dv.page(link);

            if (page) {
                return dv.fileLink(page.file.path, false, name);
            }

            return name;
        });

        elements.push("(" + group.map(e =>
            typeof e === "string" ? e : e
        ).join(" or ") + ")");

        continue;
    }

    // -------------------------
    // NORMAL REQUIREMENT
    // -------------------------
    const name = normalizeName(req);
    const link = normalizeLink(req);

    if (!name) continue;

    const page = dv.page(link);

    if (page) {
        elements.push(dv.fileLink(page.file.path, false, name));
    } else {
        elements.push(name);
    }
}

// -------------------------
// OUTPUT
// -------------------------
const output = elements
    .filter(Boolean)
    .map(e => typeof e === "string" ? e : e)
    .join("; ");

dv.paragraph("**Requirements:** " + output);