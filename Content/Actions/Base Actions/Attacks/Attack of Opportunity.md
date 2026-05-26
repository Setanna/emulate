---
seconds: -1
traits:
 - link: "[[Rules/Traits/Attack]]"
 - link: "[[Reactive]]"
 - link: "[[Rules/Traits/Item | Item (Melee Weapon)]]"
reaction_triggers:  
- text: "A creature within your Reach does any of the following:"
  items:
    - "Takes an Action with the [[Rules/Traits/Movement|Movement]] Trait"  
    - "Takes the [[Interact]] Action"  
    - "Makes a Ranged Weapon Attack"  
    - "Casts a Spell"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
*Flavor text*

**System:**
You make a [[Making a Strike | Strike]] against the creature that triggered the Attack of Opportunity.

Alternatively instead of making a [[Making a Strike | Strike]], you can take a [[Maneuver]] Action, targeting the creature.
