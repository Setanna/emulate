let page = input;

if (!page) return;

let traits = page.traits ?? [];

let wrap = dv.container.createDiv("traits-wrapper");

for (let trait of traits) {
    let path = trait.link.path?.trim();

    // If the path can't be found, print missing trait instead.
    if (!path) {
       printTrait("Missing Trait", "missing-trait", undefined); 
       continue;
    }

    let name = trait.link.display ? trait.link.display : path.split("/").pop().replace(".md", "");

    let css = trait.css ?? "trait";

    printTrait(name, css, path);
}

// If there are more than 0 traits, clear all style and bump the css
if (traits.length > 0) {
    dv.el("div", "", {
        attr: { style: "clear: both; margin-top: -0.3rem;" }
    });
}

// Print the trait
function printTrait(name, css, link) {
   let el = wrap.createEl("a", {
        text: name,
        cls: ["internal-link", css].join(" ")
    });

    if (link) {
       el.setAttribute("href", link);
       el.setAttribute("data-href", link);
    }

    el.setAttribute("target", "_blank");
    el.setAttribute("rel", "noopener nofollow");
}