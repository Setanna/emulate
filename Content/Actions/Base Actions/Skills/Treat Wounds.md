---
seconds: 4
traits:
 - link: "[[Rules/Traits/Item | Item (Medicine Kit)]]"
 - link: "[[Skill | Skill (Medicine)]]"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
*Flavor text*

**System:**
You make a [[Medicine]] Roll with a [[Circumstance]] Penalty equal to the targets Armor Value.

**Critical Success:** The creature regains a number of Hit Points equal to your Wisdom + 1 (minimum 2).
**Success:** The creature regains a single Hit Points.
**Fail:** The creature regains not Hit Points.
**Critical Fail:** The creature takes a single point of damage.

A Creature can only regain a number of Hit Points up to their Constitution with this Action.
