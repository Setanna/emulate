---
price: 450
augments:
- "Armor"
flavor_text:
- text: "The armor resists critical precision at the cost of mobility"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/augment_title", {
    path: dv.current().file.path
});
```

**System:**
While wearing the Armor any Attacker needs to roll one higher for the purposes of Critical Success.

<br>

Additionally the Armor's Maneuverability Penalty is increased by one.