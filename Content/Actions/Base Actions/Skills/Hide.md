---
seconds: 1
traits:
 - link: "[[Skill | Skill (Stealth)]]"
reaction_triggers:
 - text: "Someone is about to spot you"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
*Flavor text*

**System:**
You Roll a [[Stealth]] Roll against all surrounding creatures [[Perception]] DC. Any Perception Modifiers such as range or closed doors reduce the [[Perception]] DC by their respective amount.

**Success:** The creature is [[Unaware]] of you.
**Fail:** The creature knows someone is hiding and the rough direction of the creature.
**Critical Fail:** The creature knows your specific location.

> ### Example
> 1. A Kobold would like to stealth by a Human and rolls a 14.
> 2. The Human has a Perception Bonus of 6, giving them a Perception DC of 16.
> 	2.1 The Kobold is 3 Meters away reducing the Perception DC by 3.
> 3. The Kobold Succeeds their Stealth with a 14 vs 13




