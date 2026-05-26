---
seconds: 1
traits:
 - link: "[[Movement]]"
 - link: "[[Stance]]"
requires:
 - "You wield no Armor, Shields or Weapons"
 - "You are Light Load"
 - "You took an Action with the [[Rules/Traits/Movement | Movement]] Trait last round"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
*You kick off your foes like a leaf on the wind, flowing effortlessly from one to the next*

**System:**
Your [[Step]] Action gains the following triggers:

**Free Triggers:** 
- When you take the [[Attack]] Action.
- After you take the [[Attack]] Action.
