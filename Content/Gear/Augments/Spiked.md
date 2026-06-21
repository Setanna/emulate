---
price: 150
augments:
- "Armor"
- "Shields"
flavor_text:
- text: "Wicked barbs crown the armor's surface, drawing blood from every collision"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/augment_title", {
    path: dv.current().file.path
});
```

**System:**
The Armor or Shield gains the [[Rules/Traits/Spiked | Spiked (d4)]] Trait. If it already has the [[Rules/Traits/Spiked | Spiked]] or [[Bash]] Trait instead increase it's value by one, and turn the [[Bash]] Trait into the [[Rules/Traits/Spiked | Spiked]] Trait with a same value.
