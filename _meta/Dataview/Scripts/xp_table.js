export async function createXPTable(total, rows, dv) {
    // Add heading
    dv.header(1, "XP Distribution");

    // Render table
    dv.table(["Name", "XP"], [
        ...rows,
        ["Total", total]
    ]);
}


