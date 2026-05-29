---
seconds: 0
traits:
 - link: "[[Reactive]]"
free_action_triggers:
 - text: "When you take an Action or are the Target of an Action"
flavor_text:
 - text: "Stand. Believe. Endure"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
You gain a [[Morale]] Bonus to your next Roll for the Triggering Action. The [[Morale]] Bonus is equal to the amount of Spell Points you expend on this Action to a maximum of your Charisma.
