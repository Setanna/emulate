---
seconds: -1
traits:
 - link: "[[Reactive]]"
 - link: "[[Rules/Traits/Item | Item (Shield)]]"
reaction_triggers:
 - text: "You or your ally within Reach is the Target of an Action with the [[Rules/Traits/Attack | Attack]] or [[Blast]] Trait"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
*Flavor text*

**System:**
You raise your shield and double its Shield and [[Bulwark]] Value against the Triggering Action. 
If you Blocked for you ally, you lose your Shield Value and they instead gain the Doubled Shield and [[Bulwark]] Value against the Triggering Action instead.
