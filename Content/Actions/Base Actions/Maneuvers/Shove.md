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
You Roll Athletics against target Creature's [[Athletics]] or [[Acrobatics]] DC, whichever is higher. You may move with the creature you shove, up to your speed.

<br>

**Critical Success:** You move the creature up to your Strength + 1 in meters and it gains the [[Prone]] Condition.
**Success:** You move the creature 1 meter
**Failure:** Nothing happens
**Critical Fail:** You gain the [[Prone]] Condition.

