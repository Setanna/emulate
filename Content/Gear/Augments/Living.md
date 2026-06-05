---
price: 1000
augments:
- "Gear with the [[Material | Material (Wood)]]"
flavor_text:
- text: "Rain nourishes the living grain, mending fractures that would break lesser wood"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/augment_title", {
    path: dv.current().file.path
});
```

**System:**
The Item loses the [[Material | Material (Wood)]] Trait and gains the [[Material | Material (Living Wood)]] Trait.

<br>

Whenever the Item would gain the [[Drenched | Drenched (Wet)]] Condition it counteracts the [[Broken]] Condition.