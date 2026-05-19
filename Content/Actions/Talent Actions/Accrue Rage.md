---
seconds: 1
traits:
 - link: Emotion
   display: Emotion (Anger)
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**Free Triggers:**
- After you take or deal damage

**Requirements:** [[Rage]]
___
*Your rage grows, quiet but relentless*

<br>

**System:**
You gain [[Rules/Mechanics/Resources/Rage | Rage]] Points. The number of [[Rules/Mechanics/Resources/Rage | Rage]] Points you gain is equal to the damage you dealt or took *after damage reduction*, to a minimum of one.
