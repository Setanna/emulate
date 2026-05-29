---
seconds: 1
traits:
 - link: "[[Timed]]"
flavor_text:
 - text: "You steel yourself for the pain to come"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
You gain a number of [[Temporary Hit Points]] equal to your Constitution until the End of the Encounter.