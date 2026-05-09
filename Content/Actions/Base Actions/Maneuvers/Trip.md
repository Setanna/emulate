---
tags: []
cssclass: pathfinder
seconds: 2
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
You Roll Athletics against target Creature's [[Athletics]] or [[Acrobatics]] DC, whichever is higher.

<br>

**Critical Success:** The creature gains the [[Prone | Prone 3]] Condition
**Success:** The creature gains the [[Prone | Prone 1]] Condition
**Failure:** Nothing happens
**Critical Fail:** You gain the [[Prone | Prone 3]] Condition
