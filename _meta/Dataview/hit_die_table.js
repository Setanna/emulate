const data = dv.current().costs ?? [];

// Sort by die size descending (optional, keeps d12 → d4 order)
data.sort((a, b) => b.die - a.die);

// Build table
dv.table(
  ["Hit Die", "Total XP Cost"],
  data.map(c => [
    `d${c.die}`,
    c.xp > 0 ? `+${c.xp}` : `${c.xp}`
  ])
);