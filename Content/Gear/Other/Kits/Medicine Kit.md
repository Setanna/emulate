---
price: 20
uses: 25
traits:
- link: "[[Kit]]"
flavor_text:
- text: "A leather pouch containing everything needed to save a life"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/gear_title", {
    path: dv.current().file.path
});
```

**System:**
A Medicine Kit contains everything from bandages to alcohol and is needed for most Medicine related actions.