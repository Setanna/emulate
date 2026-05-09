---
tags: []
cssclass: pathfinder
seconds: 4
traits:
 - link: Maneuver
 - link: Movement
 - link: Skill
   display: "Skill (Athletics)"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**Requirements:** At least one hand free

___

**System:**
You move up to twice your speed and ram yourself into a creature. You Roll [[Athletics]] against each creature who's square you enter. You must move at least a number of meters equal to your speed to use the Ram Action.

<br>

**Critical Success:** You move the creature up to your Strength in meters, and it gains the [[Prone]] Condition. 
**Success:** You move the creature 1 meter. 
**Failure:** You stop in front of the creature.
**Critical Failure:** You stop in front of the creature and gain the [[Prone]] Condition.

<br>

Additionally for each +1 [[Circumstance]] Bonus gained from the [[Momentum]] Trait, move the creature an additional meter.
