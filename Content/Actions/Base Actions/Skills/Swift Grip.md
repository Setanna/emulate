---
tags: []
cssclass: pathfinder
seconds: -1
traits:
 - link: Reactive
 - link: Skill
   display: "Skill (Climb)"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**Requirements:** Both hands free.
**Reaction Trigger:** You are [[Falling]].
___

**System:**
You Roll a [[Rules/Stats and Skills/Skills/Strength/Climb | Climb]] Skill Check against the DC of the surface you are falling past. While holding onto the edge you are [[Flat-Footed]].

<br>

Alternatively you can use only one hand to grab onto an edge, leaving the other hand free for a torch or weapon, doing so incurs a -4 [[Circumstance]] Penalty to the [[Rules/Stats and Skills/Skills/Strength/Climb | Climb]] Skill Check.

<br>

**Critical Success:** You grab onto an edge without taking damage.
**Success:** You take bludgeoning damage equal to half the meters fallen rounded down.,
**Fail:** You fail to grab onto an edge.

<br>

The number of meters fallen before grabbing onto the edge, is determined by the DC of the surface divided by five. So a DC 25 Climbing Surface has a viable ledge to grab onto 5 meters down.



