---
seconds: -2
traits:
 - link: "[[Focus]]"
flavor_text:
 - text: "Inhale. Exhale. Continue"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
For each Second spend, reduce your [[Fatigued]] Condition by one.
