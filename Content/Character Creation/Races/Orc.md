---
tags: []
cssclass: pathfinder  
size: medium
hit_die: 10
speed: 5
purchases:
 - link: Indomitable
 - link: Tusks
 - link: Orcish Sight
traits:
 - link: Size
   display: Medium
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

<div style="clear:both" /> 

![[Orc.jpg]]{.thumbnail}

___

**Hit Die:** d10
**Ground Movement:** 5 meters
**Affinities:** [[Affinity#Minor Positive Affinity (+) | +Strength]]; [[Affinity#Minor Positive Affinity (+) | +Constitution]]; [[Affinity#Minor Negative Affinity (-) | -Dexterity]]; [[Affinity#Minor Negative Affinity (-) | -Intelligence]]

___

**Flavor:**
Most Orc factions strive in Might is Right tribal environments, where they are constantly pushed to power over their superiors. This constant need for power tend to make Orcs great barbarians and war mongers.

**Description:**
Orcs vary from 1.8 to 2 meters tall and weight 80 to 130 kg. Orcs typically sport pale to dark green skin with oversized tusks.

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