---
seconds: 3
traits:
 - link: "[[Rules/Traits/Attack]]"
 - link: "[[Rules/Traits/Item | Item (Weapon)]]"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
*Flavor text*

**System:**
You make a [[Making a Strike | Strike]].

You can grant the [[Accurate]] or [[Daring]] Trait to this Action. The Traits have a value equal to half the Stat used to make the Attack Roll.

If the weapon has the [[Rules/Traits/Light | Light]] Trait, the [[Accurate]] Trait instead has the value equal to your Stat.

If the weapon has the [[Heavy]] Trait, the [[Daring]] Trait instead has the value equal to your stat.

If the weapon has neither the [[Heavy]] or [[Rules/Traits/Light | Light]], you can spend an additional Second on this Action, to make the chosen Trait's Value equal to your Stat, instead of half.

*[[Heavy]] weapons cannot gain the [[Accurate]] Trait and [[Rules/Traits/Light | Light]] weapons cannot gain the [[Daring]] Trait.*
