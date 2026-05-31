// _meta/Dataview/weapon_tables.js

// Parse markdown link format like "[[Bash | Bash (d4)]]"
function parseTraitLink(linkInput) {
    // Convert to string if it's an object
    let linkString = typeof linkInput === 'string' ? linkInput : String(linkInput);
    
    // Check if there's a pipe separator
    if (linkString.includes('|')) {
        let parts = linkString.split('|');
        return {
            target: parts[0].trim().replace(/^\[\[/, '').replace(/\]\]$/, ''),
            display: parts[1].trim().replace(/^\[\[/, '').replace(/\]\]$/, '')
        };
    }
    
    return {
        target: linkString.replace(/^\[\[/, '').replace(/\]\]$/, ''),
        display: linkString.replace(/^\[\[/, '').replace(/\]\]$/, '')
    };
}

const weapons = dv.pages('"Content/Gear/Weapons"')
    .where(p => p.file.name !== dv.current().file.name);

// Group by proficiency first
const proficiencyGroups = {
    Simple: [],
    Advanced: [],
    Exotic: []
};

for (let weapon of weapons) {
    if (proficiencyGroups[weapon.proficiency]) {
        proficiencyGroups[weapon.proficiency].push(weapon);
    }
}

// Render each proficiency section first
for (let [proficiency, items] of Object.entries(proficiencyGroups)) {

    if (items.length === 0) continue;

    dv.header(1, `${proficiency} Weapons`);

    // Split into Melee / Ranged inside proficiency
    const melee = items.filter(w => w.type === "Melee");
    const ranged = items.filter(w => w.type === "Ranged");

    function renderTable(list, label, isRanged) {

        if (list.length === 0) return;

        dv.header(2, `${label} Weapons`);

        list.sort((a, b) => a.weapon_value - b.weapon_value);

        dv.table(
            [
                "Name",
                "Damage Die",
                ...(isRanged ? ["Range Increment"] : []),
                "Traits",
                "Cost",
                "Weight"
            ],
            list.map(weapon => [

                weapon.file.link,

                `1d${weapon.damage_die}`,

                ...(isRanged
                    ? [`${weapon.range_increment ?? "-"} meters`]
                    : []),

                (weapon.traits ?? [])
                    .map(t => ({ ...t, parsed: parseTraitLink(t.link) }))
                    .filter(t => t.parsed.target !== "Material")
                    .filter(t => t.parsed.target !== "Worn")
                    .map(t => {
                        let name = t.value ? `${t.parsed.display} ${t.value}` : `${t.parsed.display}`;
                        return dv.fileLink(t.parsed.target, false, name);
                    })
                    .join(", "),

                weapon.price >= 100
                    ? `${weapon.price / 100} sc`
                    : `${weapon.price} cc`,

                `${weapon.weight} kg`,
            ])
        );

        dv.paragraph("");
    }

    renderTable(melee, "Melee", false);
    renderTable(ranged, "Ranged", true);
}