---
value: 1 to 5
flavor_text:
 - text: "Whether by blast, blade, or curse, your hearing has faded into memory"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/affliction_title", {
    path: dv.current().file.path
});
```

**System:**
You gain the [[Deafened]] Condition with a value equal to this Impairment's level.
