// Calculate the experience cost of speed
export function calculateSpeedCost(speed, dv) {
    let total = 0;
    let rows = [];
    let speed_link = "Rules/Race/Movement";

    // Get the costs table from the "Movement" page
    let speed_costs = dv.page(speed_link)?.costs ?? [];

    // Find matching speed
    speed = speed_costs.find(
        speed_cost => speed_cost.meters === speed
    ) ?? undefined;

    if (speed?.xp && speed?.meters) {
        total += speed.xp;

        // Make name
        let name = `Speed ${speed.meters} Meters`;

        // Make clickable link
        let link_element = dv.fileLink(speed_link, false, name);

        // Add row
        rows.push([link_element, speed.xp]);
    }

    return { total, rows };
}