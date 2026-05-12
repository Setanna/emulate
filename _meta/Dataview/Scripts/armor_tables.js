// _meta/Dataview/armor_table.js

// Get all armor pages except this file
const armors = dv.pages('"Content/Gear/Armor and Shields/Armor"')
    .where(p => p.file.name !== dv.current().file.name);

// Group by proficiency
const groups = {
    Light: [],
    Medium: [],
    Heavy: []
};

// Sort armor into groups
for (let armor of armors) {
    if (groups[armor.proficiency]) {
        groups[armor.proficiency].push(armor);
    }
}

// Render each table
for (let [proficiency, items] of Object.entries(groups)) {

    if (items.length === 0) continue;

    // Section header
    dv.header(1, `${proficiency} Armor`);

    // Sort by armor value
    items.sort((a, b) => a.armor_value - b.armor_value);

    // Create table
    dv.table(
        [
            "Name",
            "Traits",
            "Cost",
            "Weight",
            "<span title='Armor Value'>AV</span>",
            "<span title='Dexterity Penalty'>Dex</span>",
            "<span title='Strength Requirement'>Str</span>",
            "<span title='Maneuverability Penalty'>Man</span>"
        ],
        items.map(armor => [

            armor.file.link,

            (armor.traits ?? [])
                .filter(t => t.link !== "Material")
                .filter(t => t.link !== "Worn")
                .map(t => {
		    // Make name
                    let name = t.value ? `${t.link} ${t.value}` : `${t.link}`;

                    // Make clickable link
                    let link_element = dv.fileLink(t.link, false, name);

                    return link_element;
                })
                .join(", "),

            armor.price >= 100
                ? `${armor.price / 100} sc`
                : `${armor.price} cc`,

            `${armor.weight} kg`,

            armor.armor_value ?? 0,

            armor.dexterity_penalty ?? 0,

            armor.strength_requirement ?? 0,

	    armor.maneuverability_penalty ?? 0
        ])
    );

    dv.paragraph("");
}