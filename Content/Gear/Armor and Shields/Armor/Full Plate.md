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
  - link: "[[Worn | Worn (Armor)]]"
  - link: "[[Material | Material (Steel)]]"
  - link: "[[Loud]]"
  - link: "[[Bash | Bash (d4)]]"
  - link: "[[Bulwark]]"
    value: 3
  - link: "[[Cumbersome]]"
    value: 1
flavor_text:
 - text: "Heavy, unyielding, and nearly impenetrable"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/armor_title", {
    path: dv.current().file.path
});
```