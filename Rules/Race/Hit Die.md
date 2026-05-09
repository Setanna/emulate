---
tags: []
cssclass: pathfinder
costs:
  - die: 12
    xp: 64
  - die: 10
    xp: 32
  - die: 8
    xp: 0
  - die: 6
    xp: -32
  - die: 4
    xp: -64
---

# Hit Die

>[!info|right] Example
>A Human with a d8 Hit Die and a Constitution of 2 would have 10 Hit Points

Each Race has a Hit Die; d4, d6, d8, d10 or d12. The number of Hit Points gained from a race is equal to the highest number on the die plus Constitution. 

The given hit die also determines how well a race's body can heal it's own wounds. After an uninterrupted [[Resting#Long Rest | Long Rest]], the creature rolls it's hit die and regains that many hit points, to a minimum of their Constitution.

The following is the Experience Cost of a given Hit Die when creating Races:

```dataviewjs
dv.view("_meta/Dataview/Scripts/hit_die_table", dv.current());
```