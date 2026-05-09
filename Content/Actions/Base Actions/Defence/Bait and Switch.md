---
tags: []
cssclass: pathfinder
seconds: -1
traits:
 - link: Reactive
 - link: Skill
   display: "Skill (Bluff)"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**Reaction Trigger:** You are the target of an Action with the [[Attack]] Trait.
___

**System:**
You lure your enemy into a false sense of advantage, only to leave their blade slicing empty air. You Roll Bluff against the incoming Attack Roll

<br>

**Success:** The attack counts as a Miss.
**Fail:** You reduce the damage taken by your Charisma.
**Critical Fail:** You take full damage from the attack.




