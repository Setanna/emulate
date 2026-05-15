---
seconds: -1
traits:
 - link: Rules/Traits/Attack
   display: "Attack"
 - link: Reactive
 - link: Rules/Traits/Item
   display: "Item (Melee Weapon)"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**Reaction Trigger:** A creature within your Reach does any of the following:
- Takes an Action with the [[Movement]] Trait
- Takes the [[Interact]] Action.
- Makes a Ranged Weapon Attack
- Casts a Spell

___

<br>

**System:**
You make a [[Making a Strike | Strike]] against the creature that triggered the Attack of Opportunity.

<br>

Alternatively instead of making a [[Making a Strike | Strike]], you can take a [[Maneuver]] Action, targeting the creature.
