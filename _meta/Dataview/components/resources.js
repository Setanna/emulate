const resources = dv.current().resources;

if (!resources || resources.length === 0) return;

// ---------------------------------
// HELPERS
// ---------------------------------

function renderLinks(text) {
    if (!text) return "";

    // Replace [[link]] or [[link|alias]] with clickable links
    return text.replace(/\[\[([^\]]+)\]\]/g, (match, inner) => {

        const [path, alias] = inner.split("|").map(s => s.trim());

        const display = alias ?? path;

        const page = dv.page(path);

        if (page) {
            return dv.fileLink(page.file.path, false, display);
        }

        return display;
    });
}

// ---------------------------------
// RENDER EACH RESOURCE
// ---------------------------------

for (const resource of resources) {

    // ---------------------------------
    // HEADER
    // ---------------------------------
    dv.header(3, `${resource.name} Points`);

    // ---------------------------------
    // TRAITS
    // ---------------------------------
    if (resource.traits) {
        await dv.view("traits", {
            traits: resource.traits
        });
    }

    // ---------------------------------
    // DIVIDER
    // ---------------------------------
    dv.container.appendChild(document.createElement("hr"));

    // ---------------------------------
    // SYSTEM TEXT
    // ---------------------------------
    if (resource.system) {

        const rendered = renderLinks(resource.system);

        dv.paragraph(rendered);
    }
}