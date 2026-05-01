const { calculateXP } = await import(
    app.vault.adapter.getResourcePath("_meta/Dataview/xp_calc.js")
);

let page = input;

const value = await dv.view("_meta/Dataview/xp_calculate", page);
//const value = calculateXP(page, dv);

let name = page.file?.name ?? "Untitled";

// Create <h1>
let h1 = dv.el("h1", "");

// Left side (name)
h1.appendText(name);

// Right side (value)
let span = document.createElement("span");
span.style.marginLeft = "auto";
span.textContent = `${value} XP`;

h1.appendChild(span);