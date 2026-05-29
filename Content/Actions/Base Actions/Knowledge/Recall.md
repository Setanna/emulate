---
seconds: 1
traits:
 - link: "[[Focus]]"
 - link: "[[Skill | Skill (Knowledge)]]"
flavor_text:
- text: "You quickly scour your mind for any piece of information to help you"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
You Roll the relevant [[Knowledge]] Roll. If you would fail you can not use the Recall Action on the same Task again.
