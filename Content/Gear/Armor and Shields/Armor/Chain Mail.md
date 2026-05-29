---
tags: []
cssclass: pathfinder
price: 720
armor_value: 4
weight: 12
proficiency: Medium
dexterity_penalty: 1
strength_requirement: 1
maneuverability_penalty: 1
traits:
  - link: "[[Worn | Worn (Armor)]]"
  - link: "[[Material | Material (Steel)]]"
  - link: "[[Loud]]"
flavor_text:
 - text: "Linked steel rings built to endure heavy blows"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/armor_title", {
    path: dv.current().file.path
});
```