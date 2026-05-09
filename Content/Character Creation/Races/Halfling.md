---
tags: []
cssclass: pathfinder
size: short
hit_die: 6
speed: 5
purchases:
 - link: Brave
 - link: Fortunate
 - link: Lucky
traits:
 - link: Size
   display: Short
   css: size-trait
 - link: Humanoid
---

```dataviewjs
const { calculateXP } = await import(
    app.vault.adapter.getResourcePath("_meta/Dataview/calculate_xp.js")
);

let page = dv.current();
const { total, rows } = await calculateXP(page, dv);

page.xp = total;

page.rows = rows;

dv.view("_meta/Dataview/xp_title", page);
dv.view("_meta/Dataview/traits", dv.current());
```

![[Halfling.png]]{.thumbnail}

___

**Hit Die:** d6
**Ground Movement:** 4 meters
**Affinities:** [[Affinity#Minor Positive Affinity (+) | +Dexterity]]; [[Affinity#Minor Negative Affinity (-) | -Strength]]

___

**Flavor:**
Don’t let their size fool you—Halflings walk the world with luck in their pockets and adventure in their hearts.

**Description:**
Halfling tend to be on the smaller side, as such they stand between 1.2 and 1.4 meters tall and weighing in at 20 to 40 kgs.

# XP Distribution

```dataviewjs
const { calculateXP } = await import(
    app.vault.adapter.getResourcePath("_meta/Dataview/calculate_xp.js")
);
const { createXPTable } = await import(
    app.vault.adapter.getResourcePath("_meta/Dataview/xp_table.js")
);

let page = dv.current();

const { total, rows } = await calculateXP(page, dv);

createXPTable(total, rows, dv);
```