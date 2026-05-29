---
seconds: -1
traits:
 - link: "[[Reactive]]"
 - link: "[[Rules/Traits/Item | Item (Armor)]]"
reaction_triggers:
 - text: "You are the Target of an Action with the [[Accurate]] Trait"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
You quickly twist your body to let your armor take the blow. The Action is resolved as if it was made without the [[Accurate]] Trait.





