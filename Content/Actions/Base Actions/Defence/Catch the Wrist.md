---
seconds: -1
traits:
 - link: "[[Reactive]]"
requires:
 - "You have a hand free"
reaction_triggers:
 - text: "You or your ally within Reach is the Target of an [[Rules/Traits/Attack | Attack]] and the Attacker is within your Reach"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
*Flavor text*

**System:**
You grab the wrist of the Attacker. You make an [[Athletics]] Roll against one creature's [[Acrobatics]] or [[Athletics]] DC, whichever is higher.

**Critical Success:** The attack counts as a Miss. You gain the [[Grappling | Grappling (Creature)]] Condition and the creature gains the [[Grappled | Grappled (You)]] Condition.
**Success:** You reduce the damage taken by your Strength.


