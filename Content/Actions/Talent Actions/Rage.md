---
seconds: 1
traits:
 - link: "[[Emotion | Emotion (Anger)]]"
requires:
 - "You have 2 or more [[Rules/Mechanics/Resources/Rage | Rage]] Points"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
*A quiet breath, before the the battlecry*

**Cost:**
This action cost an additional 2 [[Rules/Mechanics/Resources/Rage | Rage]] Points to use.

**System:**
You gain the [[Enraged]] Condition.
