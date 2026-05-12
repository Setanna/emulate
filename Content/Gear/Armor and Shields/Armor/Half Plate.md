---
tags: []
cssclass: pathfinder
price: 2400
armor_value: 8
weight: 20
proficiency: Heavy
dexterity_penalty: 2
strength_requirement: 2
maneuverability_penalty: 2
traits:
  - link: Worn
    value: Armor
  - link: Material
    value: (Steel)
  - link: Loud
  - link: Bash
    value: 1d4
  - link: Bulwark
    value: 2
---

```dataviewjs
await dv.view("_meta/Dataview/Components/armor_title", {
    path: dv.current().file.path
});
```
*Built to endure without slowing the wearer*

