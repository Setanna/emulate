---
tags: []
cssclass: pathfinder
hit_die: 10
speed: 6
purchases:
 - link: Intimidating
 - link: Draconic Affinity
 - link: Draconic Claws
 - link: Draconic Horns
 - link: Draconic Scales
 - link: Draconic Sight
 - link: Draconic Tail
 - link: Skill Proficiency
   display: Skill Proficiency (Intimidation)
 - link: Skill Proficiency
   display: Skill Proficiency (Perception)
traits:
 - link: Size
   display: Medium
   css: size-trait
 - link: Draconic
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

![[Dragonborn.jpg]]{.thumbnail}

___

**Hit Die:** d10
**Ground Movement:** 6 meters
**Affinities:** [[Affinity#Minor Positive Affinity (+) | All Stats]]

___

> [!warning] Warning
> For all other races Affinities are mirrored as to not affect XP. Dragonborn's unique positive affinity for all stats is in playtest

**Flavor:**
Dragonborn a rumored to stem directly from dragons, as their given name suggests. Whether or not there is truth to the rumor matters little to the Dragonborn as they carve out their own place in the world.

**Description:**
Dragonborn tend to be massive and frightening as the dragons they stem from. As such they stand between 1.8 and 2 meters tall and weighing in at 80 to 130 kgs.


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