---
tags: []
cssclass: pathfinder
price: 3000
armor_value: 9
weight: 24
proficiency: Heavy
dexterity_penalty: 2
strength_requirement: 2
maneuverability_penalty: 2
traits:
  - link: Worn
    value: (Armor)
  - link: Material
    value: (Steel)
  - link: Loud
  - link: Bash
    value: (d4)
  - link: Bulwark
    value: 3
  - link: Cumbersome
    value: 1
---

```dataviewjs
await dv.view("_meta/Dataview/Components/armor_title", {
    path: dv.current().file.path
});
```
*Heavy, unyielding, and nearly impenetrable*

