const data = dv.current().costs ?? [];

// Sort by die size descending (optional, keeps speed 9 → 1 order)
data.sort((a, b) => b.speed - a.speed);

// Build table
dv.table(
  ["Speed", "Total XP Cost"],
  data.map(c => [
    `${c.speed}`,
    c.xp > 0 ? `+${c.xp}` : `${c.xp}`
  ])
);