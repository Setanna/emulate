let page = input;

// Load affinity settings (this file)
let affinities = page.cost_change ?? [];

// Load base ability score table
let ability_scores = dv.page("Ability Scores");

let ability_score_costs = ability_scores?.costs ?? [];

// Sort highest → lowest
ability_score_costs.sort((a, b) => b.score - a.score);

// Format helper
function fmt(n) {
    return n > 0 ? `+${n}` : `${n}`;
}

// Build tables
for (let affinity of affinities) {

    let adjustment = Number(affinity.adjustment);
    let symbol = affinity.affinity;

    // Determine label
    let type =
        adjustment < 0
            ? (Math.abs(adjustment) === 1 ? "Minor Negative" : "Major Negative")
            : (adjustment === 1 ? "Minor Positive" : "Major Positive");

    dv.header(5, `${type} Affinity (${symbol})`);

    let rows = [];

    for (let ability_score_cost of ability_score_costs) {
        let score = ability_score_cost.score;
        let difference = ability_score_cost.difference;
        let total = ability_score_cost.total;

        // Ratio between total and difference
        let ratio = difference !== 0 ? total / difference : 0;

        // Apply affinity adjustment
        let modified_difference = difference - (adjustment * score);

        // Scale total proportionally
        let modified_total = Math.round(modified_difference * ratio);

        rows.push([
            fmt(score),
            fmt(modified_difference),
            fmt(modified_total)
        ]);
    }

    dv.table(
        ["Ability Score", "XP Difference", "XP Total"],
        rows
    );
}