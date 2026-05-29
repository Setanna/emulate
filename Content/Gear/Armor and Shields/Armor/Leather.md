---
tags: []
cssclass: pathfinder
price: 23
armor_value: 2
weight: 3
proficiency: Light
dexterity_penalty: 0
strength_requirement: 0
maneuverability_penalty: 0
traits:
- link: "[[Worn | Worn (Armor)]]"
- link: "[[Material | Material (Leather)]]"
- link: "[[Comfy]]"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/armor_title", {
    path: dv.current().file.path
});
```