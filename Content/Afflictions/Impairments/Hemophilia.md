---
value: 2
flavor_text:
 - text: "Clotless and cruel, your blood obeys no master"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/affliction_title", {
    path: dv.current().file.path
});
```

**System:**
You only reduce your [[Bleeding]] Condition, every other time you take damage from the Condition instead of each time.
