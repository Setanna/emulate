---
seconds: 1
traits:
 - link: "[[Emotion | Emotion (Anger)]]"
requires:
 - "You have 2 or more [[Rules/Mechanics/Resources/Rage | Rage Points]]"
flavor_text:
 - text: "A quiet breath, before the battlecry"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**Cost:**
This action cost an additional 2 [[Rules/Mechanics/Resources/Rage | Rage Points]] to use.

<br>

**System:**
You gain the [[Enraged]] Condition.
