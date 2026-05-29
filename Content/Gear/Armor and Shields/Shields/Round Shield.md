---
tags: []
cssclass: pathfinder
price: 14
shield_value: 2
weight: 2.5
proficiency: Medium
dexterity_penalty: 1
strength_requirement: 1
maneuverability_penalty: 1
traits:
- link: "[[Worn | Worn (Shield)]]"
- link: "[[Material | Material (Wood, Steel)]]"
- link: "[[Bulwark]]"
  value: 1
- link: "[[Bash | Bash (d4)]]"
flavor_text:
- text: "Balanced protection trusted by countless warriors"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/shield_title", {
    path: dv.current().file.path
});
```