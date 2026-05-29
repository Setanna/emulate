---
seconds: -1
traits:
 - link: "[[Reactive]]"
 - link: "[[Skill | Skill (Bluff)]]"
reaction_triggers:
 - text: "You are the target of an Action with the [[Rules/Traits/Attack | Attack]] Trait"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
You lure your enemy into a false sense of advantage, only to leave their blade slicing empty air. You Roll Bluff against the incoming Attack Roll

<br>

**Success:** The attack counts as a Miss.
**Fail:** You reduce the damage taken by your Charisma.
**Critical Fail:** You take full damage from the attack.




