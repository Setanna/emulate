let affinity = input;

let page = dv.current();

// Load base ability score table
let ability_scores = dv.page("Ability Scores");
let ability_score_costs = ability_scores?.costs ?? [];

// Sort highest → lowest
ability_score_costs.sort((a, b) => b.score - a.score);

// Format helper
function fmt(n) {
    return n > 0 ? `+${n}` : `${n}`;
}

let adjustment = Number(affinity.adjustment);
let symbol = affinity.affinity;

let rows = [];

for (let ability_score_cost of ability_score_costs) {
    let score = ability_score_cost.score;
    let difference = ability_score_cost.difference;
    let total = ability_score_cost.total;

    let ratio = difference !== 0 ? total / difference : 0;

    let modified_difference = difference - (adjustment * score);
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