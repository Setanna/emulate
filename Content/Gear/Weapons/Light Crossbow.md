---
tags: []
cssclass: pathfinder
price: 100
weight: 2.3
damage_die: 6
damage_type: Piercing
proficiency: Simple
type: Ranged
range_increment: 10
traits:
- link: "[[Ammunition]]"
- link: "[[Material | Material (Wood, Steel)]]"
- link: "[[Mechanical]]"
  value: 2
- link: "[[Reload]]"
  value: 1
flavor_text:
- text: "Lightweight mechanism designed for fast reloads and steady aim"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/weapon_title", {
    path: dv.current().file.path
});
```