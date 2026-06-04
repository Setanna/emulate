---
seconds: 0
traits:
- link: "[[Attack]]"
- link: "[[Reactive]]"
requires:
- "You are wearing or wielding a [[Spiked]] Armor or Shield"
free_action_triggers:
- text: "You are the target of the [[Grapple]] Action"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
You take the [[Making a Strike | Strike]] against the Attacker using the Armor or Shield with the [[Rules/Traits/Spiked | Spiked]] Trait.
