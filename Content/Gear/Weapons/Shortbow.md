---
tags: []
cssclass: pathfinder
price: 9
weight: 1.1
damage_die: 6
damage_type: Piercing
proficiency: Advanced
type: Ranged
range_increment: 20
traits:
- link: "[[Ammunition]]"
- link: "[[Material | Material (Wood)]]"
- link: "[[Propulsive]]"
  value: 0
flavor_text:
- text: "Compact, reliable, and quick to loose an arrow"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/weapon_title", {
    path: dv.current().file.path
});
```