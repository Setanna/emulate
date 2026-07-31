// Calculate the experience cost of size
export function calculateSizeCost(size, dv) {
    let total = 0;
    let rows = [];
    let size_link = "Rules/Race/Size";

    // Get the costs table from the "Size" page
    let size_costs = dv.page(size_link)?.costs ?? [];

    // Find matching size
    size = size_costs.find(
        size_cost => size_cost.name === size
    ) ?? undefined;

    if (size?.xp && size?.name) {
        total += size.xp;

        // Make name
        let name = `${size.name} Size`;

        // Captalize the name
        name = name.charAt(0).toUpperCase() + name.slice(1);

        // Make clickable link
        let link_element = dv.fileLink(size_link, false, name);

        // Add row
        rows.push([link_element, size.xp]);
    }

    return { total, rows };
}