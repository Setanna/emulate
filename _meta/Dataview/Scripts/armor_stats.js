let page = input;

// Get values from frontmatter
let armor = page.armor_value ?? 0;
let weight = page.weight ?? 0;
let dexterity_penalty = page.dexterity_penalty ?? 0;
let strength_requirement = page.strength_requirement ?? 0;
let maneuverability_penalty = page.maneuverability_penalty ?? 0;
let proficiency = page.proficiency ?? "None";

// Outer container
let container = dv.el("div", "");

// LEFT BLOCK
let left = container.createEl("div");
left.style.display = "inline-block";
left.style.float = "left";

left.innerHTML = `
<b>Armor Value:</b> ${armor}<br>
<b>Weight:</b> ${weight} kg<br>
<b>Proficiency:</b> ${proficiency}
`;

// RIGHT BLOCK
let right = container.createEl("div");
right.style.display = "inline-block";
right.style.float = "right";
right.style.paddingRight = "100px";

right.innerHTML = `
<b>Dexterity Penalty:</b> ${dexterity_penalty}<br>
<b>Strength Requirement:</b> ${strength_requirement}<br>
<b>Maneuverability Penalty:</b> ${maneuverability_penalty}
`;

// CLEAR FIX
let clear = container.createEl("div");
clear.style.clear = "both";