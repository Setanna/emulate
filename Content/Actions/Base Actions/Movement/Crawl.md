---
seconds: 2
traits:
 - link: "[[Movement]]"
requires:
 - "You are [[Prone]] and your Speed is at least two meters"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
You move up to 1 meter.