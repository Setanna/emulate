---
tags: []
cssclass: pathfinder
price: 60
weight: 1.4
damage_die: 6
damage_type: Slashing
proficiency: Simple
type: Melee
traits:
  - link: Material
    value: (Steel, Wood)
  - link: Thrown
  - link: Reach
    value: 1
---

```dataviewjs
await dv.view("_meta/Dataview/Components/weapon_title", {
    path: dv.current().file.path
});
```
*A reinforced oak shaft with a broad steel head.*