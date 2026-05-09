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
await dv.view("_meta/Dataview/components/race_title", {
    path: dv.current().file.path
});
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

```dataviewjs
await dv.view("_meta/Dataview/components/race_xp_table", {
    path: dv.current().file.path
});
```