---
tags: []
cssclass: pathfinder
price: 60
weight: 1.9
damage_die: 6
damage_type: bludgeoning
proficiency: Simple
type: Melee
traits:
  - link: Material
    value: (Steel, Wood)
  - link: Light
---

```dataviewjs
await dv.view("_meta/Dataview/Components/weapon_title", {
    path: dv.current().file.path
});
```
*Small yet mighty, capable of breaking bones with a single hit.*