---
tags: []
cssclass: pathfinder
seconds: 1
traits:
 - link: Focus
 - link: [[Skill]]
   display: "Skill (Knowledge)"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
___
*You quickly scour your mind for any piece of information to help you.*

<br>

**System:**
You Roll the relevant [[Knowledge]] Roll. If you would fail you can not use the Recall Action on the same Task again.
