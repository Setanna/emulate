---
seconds: 0
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
You stand up, ending the [[Prone]] Condition. If your [[Prone]] Condition is greater than one, this Action costs 1 second instead of 0 seconds.
