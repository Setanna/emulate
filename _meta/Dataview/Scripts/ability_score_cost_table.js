let page = input;

let costs = page.costs ?? [];

// Sort from highest to lowest (optional, matches your table)
costs.sort((a, b) => b.score - a.score);

let rows = costs.map(cost => {
    let score = cost.score > 0 ? `+${cost.score}` : `${cost.score}`;
    return [score, cost.difference, cost.total];
});

// Render table
dv.table(
    ["Ability Score", "XP Difference", "XP Total"],
    rows
);