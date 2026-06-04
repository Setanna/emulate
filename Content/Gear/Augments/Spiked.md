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
The Armor or Shield gains the [[Bash | Bash (d4)]] Trait. If it already has the Trait instead increase it's value by one.

<br>

All [[Damage Types#Bludgeoning | Bludgeoning]] Damage done by the [[Bash | Bash (d4)]] Trait is instead [[Damage Types#Piercing | Piercing]] Damage.

<br>

Additionally you gain the [[Porcupine's Defense]] Action.