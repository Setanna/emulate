---
tags: []
cssclass: pathfinder
price: 960
armor_value: 6
weight: 16
proficiency: Medium
dexterity_penalty: 1
strength_requirement: 1
maneuverability_penalty: 1
traits:
  - link: Worn
    value: (Armor)
  - link: Material
    value: (Steel)
  - link: Loud
  - link: Bash
    value: (d4)
  - link: Bulwark
    value: 1
---

```dataviewjs
await dv.view("_meta/Dataview/Components/armor_title", {
    path: dv.current().file.path
});
```
*Rigid steel guarding the vital core*

