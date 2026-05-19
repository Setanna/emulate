let page = input;

let name = page.file?.name ?? "Untitled";

if (name !== "Untitled") name += " Points";

// Create <h1>
let h1 = dv.el("h1", "");

// Left side (name)
h1.appendText(name);