---
tags: []
cssclass: pathfinder
price: 60
weight: 1.3
damage_die: 4
damage_type: piercing
proficiency: Simple
type: Melee
traits:
- link: "[[Material | Material (Steel)]]"
- link: "[[Finesse]]"
- link: "[[Light]]"
- link: "[[Thrown | Thrown (3m)]]"
- link: "[[Vital Strike]]"
- link: "[[Parrying]]"
  value: 1
flavor_text:
- text: "A broad, sturdy blade with a crossguard designed to catch and deflect attacks"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/weapon_title", {
    path: dv.current().file.path
});
```