---
price: 1
traits:
- link: "[[Activation | Activation (6 Second)]]"
flavor_text:
- text: "A smooth pale stone, once activated shines like a small sun"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/gear_title", {
    path: dv.current().file.path
});
```

**System:**
A torch burns for 1 hour, shedding [[Lighting | Normal Lighting]] for 5 meters and [[Lighting | Dim Light]] for another 5 meters.