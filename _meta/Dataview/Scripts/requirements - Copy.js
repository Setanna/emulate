const requires = dv.current().requires;

if (!requires) return;

function normalizeName(req) {
    if (!req) return null;
    return req.toString().replace(/\[\[|\]\]/g, "").split("|").pop().trim();
}

function normalizeLink(req) {
    if (!req) return null;
    return req.toString().replace(/\[\[|\]\]| \|.*|\|.*/g, "").trim();
}

const elements = [];

for (const requirement of requires) {
    const name = normalizeName(requirement);

    const link = normalizeLink(requirement);

    if (!link) continue;

    const page = dv.page(link);

    if (page) {
        elements.push(dv.fileLink(page.file.path, false, name));
    } else {
        elements.push(name);
    }
}

// remove empty/invalid entries BEFORE join
const output = elements
    .filter(Boolean)
    .map(e => typeof e === "string" ? e : e)
    .join("; ");

dv.paragraph("**Requirements:** " + output);