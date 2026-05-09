---
tags: []
cssclass: pathfinder
seconds: 4
traits:
 - link: [[Rules/Traits/Attack]]
   display: "Attack"
 - link: [[Rules/Traits/Item]]
   display: "Item (Weapon)"
 - link: Safe
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
___

**System:**
You make a [[Making a Strike | Strike]] with each weapon you are wielding. Each [[Making a Strike | Strike]] counts as it's own [[Rules/Traits/Attack | Attack]] Action and suffers a -2 [[Circumstance]] Penalty. You choose the order of these Actions.

You can grant each [[Rules/Traits/Attack | Attack]] Action the [[Accurate]] or [[Daring]] Trait. The Traits have a value equal to half the Stat used to make the Attack Roll.

