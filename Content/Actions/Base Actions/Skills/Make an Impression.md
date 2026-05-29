---
seconds: 4
traits:
 - link: "[[Language]]"
 - link: "[[Skill | Skill (Diplomacy or Survival)]]"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
Roll a [[Diplomacy]] against the Creature's [[Insight]]. You can suffer a -4 [[Circumstance]] Penalty to remove the [[Language]] Trait from this Action. Additionally if you Roll against a Creature with the [[Animal]] Trait, you must instead Roll [[Survival]].

<br>

You can only change the Creature's [[Attitude]] once per Preparation.

<br>

**Critical Success:** The Creature's [[Attitude]] is increased by one step to a maximum of Friendly.
**Success:** Until the end of your next Preparation, increase the Creature's [[Attitude]] by one step.
**Fail:** The Creature's [[Attitude]] is not changed
**Critical Fail:** The Creature's [[Attitude]] is decreased by one step to a maximum of Hostile.
