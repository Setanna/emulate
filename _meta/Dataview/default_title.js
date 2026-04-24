let page = input;

let value = page.value ?? 0;
let name = page.file?.name ?? "Untitled";

// Create <h1>
let h1 = dv.el("h1", "");

// Left side (name)
h1.appendText(name);

// Right side (value)
let span = document.createElement("span");
span.style.marginLeft = "auto";
span.textContent = `${value}`;

h1.appendChild(span);