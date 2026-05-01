---
tags: []
cssclass: pathfinder
costs:
  - speed: 9
    xp: 64
  - speed: 8
    xp: 48
  - speed: 7
    xp: 32
  - speed: 6
    xp: 16
  - speed: 5
    xp: 0
  - speed: 4
    xp: -16
  - speed: 3
    xp: -32
  - speed: 2
    xp: -48
  - speed: 1
    xp: -64
---

# Movement

> [!warning] Work In Progress
> This has not been properly play tested
> This needs to be polished

```dataviewjs
dv.view("_meta/Dataview/speed_table", dv.current());
```

<br>

Additional Movement Types such as flight or burrow speed also cost additional XP. This new movement type has a base movement of 5 meters, but can be altered as per regular movement.

| Movement Type | XP Cost (5 Movement Speed) |
| ------------- | -------------------------- |
| Flight        | 80                         |
| Burrow        | 56                         |
| Climb         | 32                         |
| Swim          | 16                         | 