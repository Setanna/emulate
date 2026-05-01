let page = input;

// Get values from frontmatter
let armor = page.armor_value ?? 0;
let weight = page.weight ?? 0;
let dex = page.dexterity_penalty ?? 0;
let str = page.strength_requirement ?? 0;

// Outer container
let container = dv.el("div", "");

// LEFT BLOCK
let left = container.createEl("div");
left.style.display = "inline-block";
left.style.float = "left";

left.innerHTML = `
<b>Armor Value:</b> ${armor}<br>
<b>Weight:</b> ${weight} kg
`;

// RIGHT BLOCK
let right = container.createEl("div");
right.style.display = "inline-block";
right.style.float = "right";
right.style.paddingRight = "100px";

right.innerHTML = `
<b>Dexterity Penalty:</b> ${dex}<br>
<b>Strength Requirement:</b> ${str}
`;

// CLEAR FIX
let clear = container.createEl("div");
clear.style.clear = "both";