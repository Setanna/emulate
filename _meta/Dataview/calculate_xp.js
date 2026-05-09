export async function calculateXP(page, dv) {
   const { calculatePurchases } = await import(
       app.vault.adapter.getResourcePath("_meta/Dataview/calculate_purchases.js")
   );

   const { calculateAbilityScoreCosts } = await import(
       app.vault.adapter.getResourcePath("_meta/Dataview/calculate_ability_score_costs.js")
   );

   const { calculateHitDieCost } = await import(
       app.vault.adapter.getResourcePath("_meta/Dataview/calculate_hit_die_cost.js")
   );

   const { calculateSpeedCost } = await import(
       app.vault.adapter.getResourcePath("_meta/Dataview/calculate_speed_cost.js")
   );

   const { calculateSizeCost } = await import(
       app.vault.adapter.getResourcePath("_meta/Dataview/calculate_size_cost.js")
   );

   let rows = [];

   let total = 0;

   // Calculate size cost
   let size = page.size;

   let { total: size_total, rows: size_row } = size ? calculateSizeCost(size, dv) : { total: 0, rows: [] };

   rows.push(...size_row); // Use spread operator (...)

   total += size_total;

   // Calculate hit die cost
   let hit_die = page.hit_die;

   let { total: hit_die_total, rows: hit_die_row } = hit_die ? calculateHitDieCost(hit_die, dv) : { total: 0, rows: [] };

   rows.push(...hit_die_row); // Use spread operator (...)

   total += hit_die_total;

   // Calculate speed cost
   let speed = page.speed;

   let { total: speed_total, rows: speed_row } = speed ? calculateSpeedCost(speed, dv) : { total: 0, rows: [] };

   rows.push(...speed_row); // Use spread operator (...)

   total += speed_total;

   // Calculate ability score costs
   let ability_scores = page.ability_scores;

   let { total: ability_score_total, rows: ability_score_rows } = ability_scores ? calculateAbilityScoreCosts(ability_scores, dv) : { total: 0, rows: [] };
 
   rows.push(...ability_score_rows); // Use spread operator (...)

   total += ability_score_total;

   // Calculate purchases costs
   let purchases = page.purchases;

   let { total: purchase_total, rows: purchase_rows } = purchases ? calculatePurchases(purchases, dv) : { total: 0, rows: [] };

   rows.push(...purchase_rows); // Use spread operator (...)

   total += purchase_total;

   // Return the total and the rows
   return {total, rows};
}