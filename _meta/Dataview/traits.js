let page = input;

if (!page) return;

let traits = page.traits ?? [];

let wrap = dv.container.createDiv("traits-wrapper");

for (let Trait of traits) {
    let el = wrap.createEl("a", {
        text: Trait.display,
        cls: ["internal-link", Trait.css ?? ""].join(" ")
    });

    el.setAttribute("href", Trait.link);
    el.setAttribute("data-href", Trait.link);
    el.setAttribute("target", "_blank");
    el.setAttribute("rel", "noopener nofollow");
}

dv.el("div", "", { attr: { style: "clear: both; margin-top: -0.3rem;" } });
