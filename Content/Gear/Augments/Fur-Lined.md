---
price: 150
traits:
- link: "[[Material | Material (Fur)]]"
augments:
- "Armor"
- "Shields"
flavor_text:
- text: "Soft fur lining helps retain heat in cold climates"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/augment_title", {
    path: dv.current().file.path
});
```

> [!warning] Warning
> This will be updated when [[Weather#Temperature | Temperature]] is created

<br>

**System:**
The armor gains the [[Material | Material (Fur)]] Trait and reduces [[Damage Types#Cold | Cold]] Damage by one more.