---
tags: []
cssclass: pathfinder
hit_die: 10
movement_speed: 6
purchases:
 - link: Intimidating
 - link: Dragon Scales
 - link: Skill Proficiency
   display: Skill Proficiency (Intimidation)
 - link: Skill Proficiency
   display: Skill Proficiency (Perception)
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

<h1> Dragonborn <span style="margin-left: auto;"> 132 XP </span> </h1>

[[Size | Medium]]{.size-trait}

[[Draconic]]{.trait}

[[Humanoid]]{.trait}

<div style="clear:both" /> 

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

<br>

**Description:**
Dragonborn tend to be massive and frightening as the dragons they stem from. As such they stand between 1.8 and 2 meters tall and weighing in at 80 to 130 kgs.

<br>

**Racial Talents:**
Dragonborn start with [[Dragon Scales]]; [[Intimidating]]; [[Vision#Low-Light Vision \| Low-Light Vision]]; [[Skill Proficiency | Skill Proficiency (Intimidation)]] and [[Skill Proficiency | Skill Proficiency (Perception)]].

# XP Distribution

| Name                                                      | XP  |
| --------------------------------------------------------- |:---:|
| [[Hit Die \| d10 Hit Die]]                                | +32 |
| [[Movement \| 6 Movement Speed]]                          | +16 |
| [[Intimidating]]                                          | +4  |
| [[Dragon Scales]]                                         | +16 |
| [[Skill Proficiency \| Skill Proficiency (Intimidation)]] | +1  |
| [[Skill Proficiency \| Skill Proficiency (Perception)]]   | +1  |
| [[Vision#Low-Light Vision \| Low-Light Vision]]           | +32 |
| [[Affinity#Minor Positive Affinity (+) \| All Stats]]     | +30 |
| Total                                                     | 132 |


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