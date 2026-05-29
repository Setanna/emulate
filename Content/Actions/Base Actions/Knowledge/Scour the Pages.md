---
seconds: 2
traits:
 - link: "[[Item]]"
 - link: "[[Focus]]"
 - link: "[[Skill | Skill (Knowledge)]]"
flavor_text:
 - text: "You quickly flip through the pages for the information you need"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
You quickly scour the pages of your tome for the information you seek. You gain a bonus on the next Action you take as defined in the book you're holding.
