const data = dv.current().costs ?? [];

// Sort by die size descending (optional, keeps speed 9 → 1 order)
data.sort((a, b) => b.meters - a.meters);

// Build table
dv.table(
  ["Speed", "Total XP Cost"],
  data.map(c => [
    `${c.meters}`,
    c.xp > 0 ? `+${c.xp}` : `${c.xp}`
  ])
);