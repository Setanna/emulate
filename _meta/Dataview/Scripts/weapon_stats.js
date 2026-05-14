let page = input;

// Get values from frontmatter
let damage_die = page.damage_die ?? 0;
let damage_type = page.damage_type ?? 0;
let proficiency = page.proficiency ?? "None";
let range = page.range_increment ?? "None";
let type = page.type ?? "None";
let weight = page.weight ?? 0;

// Outer container
let container = dv.el("div", "");

// LEFT BLOCK
let left = container.createEl("div");
left.style.display = "inline-block";
left.style.float = "left";

left.innerHTML = `
<b>Damage:</b> 1d${damage_die} ${damage_type}<br>
<b>Proficiency:</b> ${proficiency}
`;

// RIGHT BLOCK
let right = container.createEl("div");
right.style.display = "inline-block";
right.style.float = "right";

if (type === "Ranged") {
    right.innerHTML = `
    <b>Weight:</b> ${weight} kg<br>
    <b>Range Increment:</b> ${range} meters
    `;
} else {
    right.innerHTML = `
    <b>Weight:</b> ${weight} kg
    `;
}

// CLEAR FIX
let clear = container.createEl("div");
clear.style.clear = "both";