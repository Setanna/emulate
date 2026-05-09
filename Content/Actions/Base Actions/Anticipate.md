---
tags: []
cssclass: pathfinder
seconds: 2
traits:
 - link: Safe
 - link: Secret
 - link: Timed
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
___
*Flavor text*

<br>

**System:**
Choose any Reaction you have access to, you gain one Split Second that you can only spent on that Reaction.

Alternatively you can choose any Action with a Second Cost of one or less. You can give that Action a Free Trigger with any condition. That Action has the given Free Trigger until the start of your next turn.

<br>

Additionally when taking this Action you can try to hide it. You roll a [[Bluff]] Skill Check against all Creature's [[Insight]] DC, as long as they can [[Perception | See]] you.

**Critical Success:** The Creature does not know you took this Action.
**Success:** The Creature knows you took this Action but does not know the Action or Reaction you chose.
**Fail:** The Creature knows what Action or Reaction you chose.

If a creature wishes to know what you chose, they must Roll a Insight Roll against your Bluff DC. On a success the creature learns what Action or Reaction you have prepared.




