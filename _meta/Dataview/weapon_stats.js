let page = input;

// Get values from frontmatter
let damage_die = page.damage.die ?? 0;
let damage_type = page.damage.type ?? 0;
let weight = page.weight ?? 0;

// Outer container
let container = dv.el("div", "");

// LEFT BLOCK
let left = container.createEl("div");
left.style.display = "inline-block";
left.style.float = "left";

left.innerHTML = `
<b>Damage:</b> ${damage_die} ${damage_type}
`;

// RIGHT BLOCK
let right = container.createEl("div");
right.style.display = "inline-block";
right.style.float = "right";

right.innerHTML = `
<b>Weight:</b> ${weight} kg
`;

// CLEAR FIX
let clear = container.createEl("div");
clear.style.clear = "both";