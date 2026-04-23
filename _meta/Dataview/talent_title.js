let page = input;

let xp = page.xp ?? 0;
let name = page.file?.name ?? "Untitled";

// Create <h1>
let h1 = dv.el("h1", "");

// Left side (name)
h1.appendText(name);

// Right side (XP)
let span = document.createElement("span");
span.style.marginLeft = "auto";
span.textContent = `${xp} XP`;

h1.appendChild(span);