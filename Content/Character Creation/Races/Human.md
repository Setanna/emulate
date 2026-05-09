---
tags: []
cssclass: pathfinder  
size: medium
hit_die: 8
speed: 5
purchases:
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

![[Human.jpg]]{.thumbnail}

___

**Hit Die:** d8
**Ground Movement:** 5 meters

___

**Description:**
Humans vary from 1.6 to 1.9 metres tall and weigh 40 to 90 kg. Their varied nature allows all sorts of colorful and and unique personalities and appearance.

**System:**
Humans have no real speciality beside their varied nature defined by their choices in life.

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