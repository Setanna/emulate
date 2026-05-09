---
tags: []
cssclass: pathfinder
seconds: 3
traits:
 - link: Maneuver
 - link: Skill
   display: "Skill (Athletics or Acrobatics)"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
___

**System:**
You Roll [[Athletics]] or [[Acrobatics]] against target Creature's [[Athletics]] or [[Acrobatics]] DC, whichever is higher. You chose an item they are holding to disarm, if the creature is holding it in two hands or more, they gain a +2 [[Circumstance]] Bonus to the DC for each additional hand after the first.

<br>

**Critical Success:** You disarm the item and it [[Scatter | Scatters to a nearby spot]]

