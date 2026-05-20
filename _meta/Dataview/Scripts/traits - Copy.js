let page = input;

if (!page) return;

let traits = page.traits ?? [];

let wrap = dv.container.createDiv("traits-wrapper");

for (let trait of traits) {
    path = trait.link.path;

    traitCss = trait.css ?? "trait";

    if (!path) traitCss = "missing-trait";

    let el = wrap.createEl("a", {
        text: trait.display ?? trait.link + (" " + (trait.value ?? "")),
        cls: ["internal-link", traitCss].join(" ")
    });

    el.setAttribute("href", trait.link.path);
    el.setAttribute("data-href", trait.link.path);
    el.setAttribute("target", "_blank");
    el.setAttribute("rel", "noopener nofollow");
}

if (traits.length > 0) {
    dv.el("div", "", { attr: { style: "clear: both; margin-top: -0.3rem;" } });
}
