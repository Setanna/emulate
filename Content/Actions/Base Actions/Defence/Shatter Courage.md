---
tags: []
cssclass: pathfinder
seconds: -1
traits:
 - link: Reactive
 - link: [[Emotion]]
   display: "Emotion (Fear)"
 - link: [[Skill]]
   display: "Skill (Intimidate)"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**Trigger:** You are the target of an [[Rules/Traits/Attack | Attack]] Action by a [[Frightened]] Creature.
___


**System:**
You shake the attacker to their core with a single look. You Roll Intimidation against the incoming Attack Roll

<br>

**Critical Success:** The Attack counts as a Miss and the Attacker's [[Frightened]] Condition increases by one.
**Success:** The Attack counts as a Miss.
**Fail:** You reduce the damage taken by your Charisma.
**Critical Fail:** You take full damage from the Attack.




