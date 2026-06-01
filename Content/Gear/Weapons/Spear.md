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
- link: "[[Material | Material (Steel, Wood)]]"
- link: "[[Thrown | Thrown (10m)]]"
- link: "[[Reach]]"
  value: 1
flavor_text:
- text: "A reinforced oak shaft with a broad steel head"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/weapon_title", {
    path: dv.current().file.path
});
```