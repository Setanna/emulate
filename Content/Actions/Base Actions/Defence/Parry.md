---
seconds: -1
traits:
 - link: "[[Reactive]]"
 - link: "[[Rules/Traits/Item | Item (Weapon or Light; Medium Shield)]]"
reaction_triggers:
 - text: "You or your ally within Reach is the Target of an Action with the [[Rules/Traits/Attack | Attack]] and [[Melee]] Trait"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
You roll an Attack against the Triggering Action's Attack.

<br>

**Critical Success:** The Action is [[counteracting | counteracted]] and it Triggers an [[Attack of Opportunity]]
**Success:** The Action is [[counteracting | counteracted]]
**Fail:** You reduce the damage taken from the Action by your Strength
**Critical Fail:** You take full damage from the Action


