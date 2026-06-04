---
price: 200
augments:
- "Armor with the [[Loud]] Trait"
flavor_text:
- text: "Thick padding muffles movement and reduces noise"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/augment_title", {
    path: dv.current().file.path
});
```

**System:**
Reduce the Penalty from the [[Loud]] Trait by two.