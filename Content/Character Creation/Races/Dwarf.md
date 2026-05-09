---
tags: []
cssclass: pathfinder  
size: short
hit_die: 12
speed: 4
purchases:
 - link: Dwarven Stoutness
 - link: Dwarven Sight
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

![[Dwarf.jpg]]{.thumbnail}

___

**Hit Die:** d12
**Ground Movement:** 3 meters
**Affinities:** [[Affinity#Minor Positive Affinity (++) | +Constitution]]; [[Affinity#Minor Negative Affinity (-) | -Dexterity]]

___

**Flavor:**
For Dwarves honor and kinship are cornerstones of their civilation. Most dwarves will have a braid in their beard for each friend lost.

**Description:**
Dwarves are short and stout like a Barrel of Ale. As such they tend to be around 1.4 to 1.6 meters and weight between 80 to 130 kgs.

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