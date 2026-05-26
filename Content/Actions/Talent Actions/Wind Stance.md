---
seconds: 1
traits:
 - link: "[[Stance]]"
requires:
 - "You are wielding a [[Damage Types | Slashing]] Melee Weapon or Ranged Weapon"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
*In stillness, the wind amplifies your reach, striking where your weapons cannot.*

**System:**
When you take an [[Rules/Traits/Attack | Attack]] Action using a [[Damage Types | Slashing]] Melee Weapon or Ranged Weapon you can grant that Action the [[Momentum]] Trait.
