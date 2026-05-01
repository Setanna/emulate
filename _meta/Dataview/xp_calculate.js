export function calculateXP(page, dv) {
   let purchases = page.purchases ?? [];

   let total = 0;

   for (let purchase of purchases) {
       // Get linked page
       let linked = dv.page(purchase.link);

       // Get display name
       let name = purchase.display ?? linked?.file?.name ?? purchase.link.path;

       let xp = 0;

       // Get XP value from linked file
       if (purchase.level) {
          xp = purchase.level*-5;
       } else {
          xp = linked?.value ?? 0;
       }

       total += xp;
   }

   return total;
}


