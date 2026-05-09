---
tags: []
cssclass: pathfinder
seconds: 3
traits:
 - link: Rules/Traits/Attack
   display: "Attack"
 - link: Rules/Traits/Item
   display: "Item (Weapon)"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
___

**System:**
You make a [[Making a Strike | Strike]].

<br> 

You can grant the [[Accurate]] or [[Daring]] Trait to this Action. The Traits have a value equal to half the Stat used to make the Attack Roll.

<br>

If the weapon has the [[Rules/Traits/Light | Light]] Trait, the [[Accurate]] Trait instead has the value equal to your Stat.

<br>

If the weapon has the [[Heavy]] Trait, the [[Daring]] Trait instead has the value equal to your stat.

<br>

If the weapon has neither the [[Heavy]] or [[Rules/Traits/Light | Light]], you can spend an additional Second on this Action, to make the chosen Trait's Value equal to your Stat, instead of half.

<br>

*[[Heavy]] weapons cannot gain the [[Accurate]] Trait and [[Rules/Traits/Light | Light]] weapons cannot gain the [[Daring]] Trait.*
