const { calculateXP } = await import(
    app.vault.adapter.getResourcePath("_meta/Dataview/Scripts/calculate_xp.js")
);
const { createXPTable } = await import(
    app.vault.adapter.getResourcePath("_meta/Dataview/Scripts/xp_table.js")
);

let page = dv.current();

const { total, rows } = await calculateXP(page, dv);

if (rows.length > 0) {
    createXPTable(total, rows, dv);
}