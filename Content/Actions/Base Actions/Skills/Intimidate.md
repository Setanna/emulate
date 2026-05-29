---
seconds: 1
traits:
 - link: "[[Emotion | Emotion (Fear)]]"
 - link: "[[Sight]]"
 - link: "[[Language]]"
 - link: "[[Skill | Skill (Intimidate)]]"
 - link: "[[Timed]]"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
Choose any number of Creatures and roll an Intimidation Skill Check against their Will Saving Throw DC. Any target that can not see you gains a +2 [[Circumstance]] Bonus to their Will Saving Throw, the same is true if they don't understand the Language used.

<br>

You can not increase any target's Frightened Value above your Charisma (Minimum 1).

<br>

**Critical Success:** The enemy is [[Frightened | Frightened 2]].
**Success:** The enemy is [[Frightened | Frightened 1]].
**Fail:** You fail to intimidate the enemy.
