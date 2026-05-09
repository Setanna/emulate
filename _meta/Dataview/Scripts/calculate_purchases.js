export function calculatePurchases(purchases, dv) {
    let total = 0;
    
    let rows = [];
    
    // Go through all the purchases
    for (let purchase of purchases) {
        // Get linked page
        let linked = dv.page(purchase.link);
    
        // Get display name
        let name = purchase.display ?? linked?.file?.name ?? purchase.link.path;
    
        let xp = 0;
    
        // Get XP value from linked file
        if (linked.price) {
           xp = Math.ceil(Number(linked.price) / 100);
        } else if (purchase.level) {
           name += " " + purchase.level;
           xp = purchase.level*-5;
        } else if (linked.value) {
           xp = linked?.value ?? 0;
        } else {
           xp = linked?.xp ?? 0;
        }
    
        total += xp;
    
        // Make clickable link
        let link_element = dv.fileLink(purchase.link, false, name);
    
        rows.push([link_element, xp]);
    }
    
    return {total, rows};
}