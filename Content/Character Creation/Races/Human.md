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
await dv.view("_meta/Dataview/Components/race_title", {
    path: dv.current().file.path
});
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

```dataviewjs
await dv.view("_meta/Dataview/Components/race_xp_table", {
    path: dv.current().file.path
});
```