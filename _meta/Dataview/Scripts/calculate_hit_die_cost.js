// Calculate the experience cost of hit die
export function calculateHitDieCost(hit_die, dv) {
    let total = 0;
    let rows = [];
    let hit_die_link = "Hit Die";

    // Get the costs table from the "Hit Die" page
    let hit_die_costs = dv.page(hit_die_link)?.costs ?? [];

    // Find matching hit die
    hit_die = hit_die_costs.find(
        hit_die_cost => hit_die_cost.die === hit_die
    ) ?? undefined;

    if (hit_die?.xp && hit_die?.die) {
        total += hit_die.xp;

        // Make name
        let name = `Hit Die d${hit_die.die}`;

        // Make clickable link
        let link_element = dv.fileLink(hit_die_link, false, name);

        // Add row
        rows.push([link_element, hit_die.xp]);
    }

    return { total, rows };
}