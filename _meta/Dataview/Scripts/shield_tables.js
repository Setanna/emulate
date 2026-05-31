// _meta/Dataview/shield_tables.js

// Parse markdown link format like "[[Worn | Worn (Armor)]]"
function parseTraitLink(linkInput) {
    // Convert to string if it's an object
    let linkString = typeof linkInput === 'string' ? linkInput : String(linkInput);
    
    // Remove outer brackets
    let link = linkString.replace(/^\[\[/, '').replace(/\]\]$/, '');
    
    // Check if there's a pipe separator
    if (link.includes('|')) {
        let parts = link.split('|');
        return {
            target: parts[0].trim(),
            display: parts[1].trim()
        };
    }
    
    return {
        target: link,
        display: link
    };
}

// Get all shield pages except this file
const shields = dv.pages('"Content/Gear/Armor and Shields/Shields"')
    .where(p => p.file.name !== dv.current().file.name);

// Group by proficiency
const groups = {
    Light: [],
    Medium: [],
    Heavy: []
};

// Sort shields into groups
for (let shield of shields) {
    if (groups[shield.proficiency]) {
        groups[shield.proficiency].push(shield);
    }
}

// Render each table
for (let [proficiency, items] of Object.entries(groups)) {

    if (items.length === 0) continue;

    // Section header
    dv.header(1, `${proficiency} Shields`);

    // Sort by shield value
    items.sort((a, b) => a.shield_value - b.shield_value);

    // Create table
    dv.table(
        [
            "Name",
            "Traits",
            "Cost",
            "Weight",
            "<span title='shield Value'>SV</span>",
            "<span title='Dexterity Penalty'>Dex</span>",
            "<span title='Strength Requirement'>Str</span>",
            "<span title='Maneuverability Penalty'>Man</span>"
        ],
        items.map(shield => [

            shield.file.link,

            (shield.traits ?? [])
                .map(t => ({ ...t, parsed: parseTraitLink(t.link) }))
                .filter(t => t.parsed.target !== "Material")
                .filter(t => t.parsed.target !== "Worn")
                .map(t => {
		    // Make name
                    let name = t.value ? `${t.parsed.display} ${t.value}` : `${t.parsed.display}`;

                    // Make clickable link
                    let link_element = dv.fileLink(t.parsed.target, false, name);

                    return link_element;
                })
                .join(", "),

            shield.price >= 100
                ? `${shield.price / 100} sc`
                : `${shield.price} cc`,

            `${shield.weight} kg`,

            shield.shield_value ?? 0,

            shield.dexterity_penalty ?? 0,

            shield.strength_requirement ?? 0,

	    shield.maneuverability_penalty ?? 0
        ])
    );

    dv.paragraph("");
}