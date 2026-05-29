---
seconds: 1
traits:
 - link: "[[Emotion | Emotion (Anger)]]"
 - link: "[[Timed]]"
requires:
 - "[[Content/Character Creation/Talents/Groups/Rage/Rage | Rage]]"
free_action_triggers:
 - text: "After you take or deal damage"
flavor_text:
 - text: "Your rage grows, quiet but relentless"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

> [!Warning|] Warning
> This Action has the Timed Trait until a solution to prevent abuse during extended encounters.

<br>

**System:**
You gain [[Rules/Mechanics/Resources/Rage | Rage]] Points. The number of [[Rules/Mechanics/Resources/Rage | Rage]] Points you gain is equal to the damage you dealt or took *after damage reduction*, to a minimum of one.
