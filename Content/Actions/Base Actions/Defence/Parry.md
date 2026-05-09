---
tags: []
cssclass: pathfinder
seconds: -1
traits:
 - link: Reactive
 - link: Rules/Traits/Item
   display: "Item (Weapon or Light; Medium Shield)"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**Reaction Trigger:**  You or your ally within reach is the target of an Action with the [[Attack]] and [[Melee]] Traits.
___

**System:**
You roll an Attack against the Triggering Action's Attack.

<br>

**Critical Success:** The Action is [[counteracting | counteracted]] and it Triggers an [[Attack of Opportunity]]
**Success:** The Action is [[counteracting | counteracted]]
**Fail:** You reduce the damage taken from the Action by your Strength
**Critical Fail:** You take full damage from the Action


