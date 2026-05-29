---
seconds: 1
traits:
reaction_triggers:
 - text: "You are the Target of an Action with the [[Rules/Traits/Attack | Attack]] or [[Blast]] Trait"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
While benefiting from cover you can crouch or move in a way to place you better behind cover; increase your cover by one step against the attack or source with the [[Blast]] Trait.