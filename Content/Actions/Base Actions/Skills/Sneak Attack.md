---
seconds: 3
traits:
 - link: "[[Attack]]"
 - link: "[[Skill | Skill (Stealth)]]"
requires:
 - "The Target is [[Unaware]] of you"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
*Flavor text*

**System:**
You Roll a [[Stealth]] Roll against all surrounding creatures [[Perception]] DC. On a success make an [[Making a Strike | Strike]]. You can spend an additional action to move up your Speed before making the attack.

> ### Example
> 1. A Kobold is hiding behind a tree and would like attack a Human keeping watch.
> 2. The Kobold rolls a 17
> 3. The Human has a Perception Bonus of 4, giving them a Perception DC of 14.
> 	2.1 The Kobold is 4 Meters away reducing the Perception DC by 4.
> 3. The Kobold Succeeds their Stealth with a 17 vs 10
> 4. The Kobold spends an additional action to move up to the Human.
> 5. The Kobold Makes a Target the Gaps Attack with a Dagger.




