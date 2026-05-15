---
seconds: 2
traits:
 - link: Maneuver
 - link: Skill
   display: "Skill (Athletics)"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**Requirements:** At least one hand free

___

**System:**
You make an [[Athletics]] Roll against one creature's [[Acrobatics]] or [[Athletics]] DC, whichever is higher.

<br>

**Success:** You gain the [[Grappling | Grappling (Creature)]] Condition and the creature gains the [[Grappled | Grappled (You)]] Condition.
**Fail:** You fail to Grapple the creature.
**Critical Fail:** You fail to Grapple the creature and the creature may make an [[Attack of Opportunity]] against you.
