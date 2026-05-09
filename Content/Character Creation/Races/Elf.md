---
tags: []
cssclass: pathfinder  
hit_die: 8
speed: 5
purchases:
 - link: Pretty
 - link: Beautiful
 - link: Calm
 - link: Skill Proficiency
   display: Skill Proficiency (Perception)
 - link: Skill Proficiency
   display: Skill Proficiency (Insight)
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

![[Elf.jpg]]{.thumbnail}

___

**Hit Die:** d8
**Ground Movement:** 5 meters
**Affinities:** [[Affinity#Minor Positive Affinity (+) | +Dexterity]]; [[Affinity#Minor Positive Affinity (+) | +Intelligence]]; [[Affinity#Minor Negative Affinity (-) | -Strength]]; [[Affinity#Minor Negative Affinity (-) | -Constitution]]


___

**Flavor:**
As graceful as they are beautiful, elves are seen as perfect lacking in flaws in both character and appearance. Their almost ageless existence also give them an unnatural calm in even the most desperate situations.

**Description:**
Elves resemble human but without warts, rashes or any imperfections. As such they tend to be 1.7 to 1.9 metres tall and weigh 40 to 90 kg. In Addition to their striking beauty Elves tend to have long and sharp ears.

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