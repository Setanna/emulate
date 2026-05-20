---
seconds: 1
traits:
 - link: "[[Skill | Skill (Bluff)]]"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
___

**System:**
Roll a [[Bluff]] Roll and choose an Action. The next time you would take the chosen Action this turn, compare the [[Bluff]] Roll against each targets [[Insight]] DC. If the chosen Action has [[Sight]], [[Verbal]] or [[Language]], this Action gains those traits.

<br>

**Success:** That Creature treats the Action as if it had the [[Secret]] Trait
**Fail:** The Creature is unaffected
