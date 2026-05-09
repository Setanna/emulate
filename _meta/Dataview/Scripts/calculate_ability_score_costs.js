// Calculate the experience cost of ability scores
export function calculateAbilityScoreCosts (ability_scores, dv) {
    let total = 0;

    let ability_score_costs = dv.page("Ability Scores")?.costs;

    // Initiate the rows variable
    let rows = [];


    // Loop through all ability_scores
    for (let ability_score of ability_scores) {
        // Get the name and data {score, affinity}
        let [name, data] = Object.entries(ability_score)[0];

        // Split data into individual variables
        let score = data.score;
        let affinity_name = data.affinity;

        // Captalize the name
        name = name.charAt(0).toUpperCase() + name.slice(1);

        // Prepend the ability score to the name
        name = (score > 0 ? "+" + score : score) + " " + name;

        let xp = 0;

        // Loop through ability_score_costs to find the cost of the ability_score
        for (let ability_score_cost of ability_score_costs) {
            // If the score is not the same as the ability_score_cost.score then skip
            if (ability_score_cost.score !== score) {
                continue;
            }

            // Set the ability_score_cost.total as it's own variable
            let total = ability_score_cost.total;

            // If the ability score has an affinity adjust the xp cost
	    if (affinity_name) {
                // Get the affinity adjustment
                let affinity = dv.page("Affinity").affinities[affinity_name];
                let adjustment = affinity.adjustment;

                let difference = ability_score_cost.difference;

                let ratio = difference !== 0 ? total / difference : 0;

                let modified_difference = difference - (adjustment * score);
                let modified_total = Math.round(modified_difference * ratio);

                // Set the xp to the modified_total
                xp = modified_total;

                // Add affinity to the name
                name = name + " with " + affinity_name;
            } else {
                // Else set the xp cost equal to the total
                xp = ability_score_cost.total;
            }
        }

        total += xp;
 
        // Set the name and xp in a row
        let row = [name, xp];

        // Push the row to rows
        rows.push(row);
    }

    return {total, rows};
}