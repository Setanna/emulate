---
seconds: 1
traits:
 - link: "[[Movement]]"
requires:
 - "You have a Speed higher than zero"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
You move a single meter up to your speed, this movement does not provoke [[Attack of Opportunity]].