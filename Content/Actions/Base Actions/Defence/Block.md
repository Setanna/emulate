---
tags: []
cssclass: pathfinder
seconds: -1
traits:
 - link: Reactive
 - link: [[Rules/Traits/Item|Item]]
   display: "Item (Shield)"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**Reaction Trigger:**  You or your ally within reach is the target of an Action with the [[Attack]] or [[Blast]] Trait.
___

**System:**
You raise your shield and double its Shield and [[Bulwark]] Value against the Triggering Action. 
If you Blocked for you ally, you lose your Shield Value and they instead gain the Doubled Shield and [[Bulwark]] Value against the Triggering Action instead.
