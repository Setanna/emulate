---
tags: []
cssclass: pathfinder
price: 32
shield_value: 3
weight: 7
proficiency: Heavy
dexterity_penalty: 2
strength_requirement: 2
maneuverability_penalty: 2
traits:
- link: "[[Worn | Worn (Shield)]]"
- link: "[[Material | Material (Wood, Steel)]]"
- link: "[[Bastion]]"
- link: "[[Bulwark]]"
  value: 2
- link: "[[Cumbersome]]"
  value: 1
flavor_text:
- text: "Massive protection built to weather brutal assaults"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/shield_title", {
    path: dv.current().file.path
});
```