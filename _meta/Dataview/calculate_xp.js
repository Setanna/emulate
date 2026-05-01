export async function calculateXP(page, dv) {
   const { calculatePurchases } = await import(
       app.vault.adapter.getResourcePath("_meta/Dataview/calculate_purchases.js")
   );

   const { calculateAbilityScoreCosts } = await import(
       app.vault.adapter.getResourcePath("_meta/Dataview/calculate_ability_score_costs.js")
   );

   let purchases = page.purchases;

   let ability_scores = page.ability_scores;

   let rows = [];

   let total = 0;

   let { total: purchase_total, rows: purchase_rows } = purchases ? calculatePurchases(purchases, dv) : { total: 0, rows: [] };

   let { total: ability_score_total, rows: ability_score_rows } = ability_scores ? calculateAbilityScoreCosts(ability_scores, dv) : { total: 0, rows: [] };

   total += purchase_total;

   total += ability_score_total;

   rows.push(...purchase_rows); // Use spread operator (...)

   rows.push(...ability_score_rows); // Use spread operator (...)

   return {total, rows};
}