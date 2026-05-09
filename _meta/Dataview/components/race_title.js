const { calculateXP } = await import(
    app.vault.adapter.getResourcePath("_meta/Dataview/Scripts/calculate_xp.js")
);

let page = dv.current();
const { total, rows } = await calculateXP(page, dv);

page.xp = total;

page.rows = rows;

dv.view("_meta/Dataview/Scripts/xp_title", page);
dv.view("_meta/Dataview/Scripts/traits", dv.current());