---
tags: []
cssclass: pathfinder
seconds: 3
traits:
 - link: Movement
 - link: Skill
   display: "Skill (Stealth)"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**Requirement:** You're benefiting from [[Benefiting from Cover | Cover]]
___

**System:**
You Roll a [[Stealth]] Roll against all surrounding creatures [[Perception]] DC. Any Perception Modifiers such as range or closed doors reduce the [[Perception]] DC by their respective amount.  You do not gain benefit from [[Benefiting from Cover | Cover]] on this Roll.

<br>

**Success:** The creature is [[Unaware]] of you, and you move up to your speed to another place that grants [[Benefiting from Cover | Cover]].
**Fail:** The creature knows someone is hiding and the rough direction of the creature.
**Critical Fail:** The creature knows your specific location.

<br>

> ### Example
> 1. A Kobold is hiding behind a tree and would like to go to another tree past a Human
> 2. The Kobold rolls a 11
> 3. The Human has a Perception Bonus of 6, giving them a Perception DC of 16.
> 	2.1 The Kobold is 4 Meters away reducing the Perception DC by 4.
> 3. The Kobold Fails their Stealth with a 11 vs 12
> 4. The Human knows someone is out in the trees and their rough direction.




