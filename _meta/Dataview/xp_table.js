export async function createXPTable(total, rows, dv) {
    // Render table
    dv.table(["Name", "XP"], [
        ...rows,
        ["Total", total]
    ]);
}


