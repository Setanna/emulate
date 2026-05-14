// _meta/Dataview/weapon_tables.js

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
                    .filter(t => t.link !== "Material")
                    .filter(t => t.link !== "Worn")
                    .map(t => {
                        let name = t.value ? `${t.link} ${t.value}` : `${t.link}`;
                        return dv.fileLink(t.link, false, name);
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