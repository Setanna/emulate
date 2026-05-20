---
size: short
hit_die: 12
speed: 4
purchases:
 - link: Dwarven Stoutness
 - link: Dwarven Sight
traits:
 - link: "[[Size | Medium]]"
   css: "size-trait"
 - link: "[[Humanoid]]"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/race_title", {
    path: dv.current().file.path
});
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

<br>

```dataviewjs
await dv.view("_meta/Dataview/Components/race_xp_table", {
    path: dv.current().file.path
});
```