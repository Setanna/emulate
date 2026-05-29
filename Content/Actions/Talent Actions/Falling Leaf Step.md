---
seconds: -1
traits:
 - link: "[[Reactive]]"
 - link: "[[Movement]]"
requires:
 - "You wield no Armor, Shields or Weapons"
 - "You are Light Load"
reaction_triggers:
 - text: "You gained the [[Prone]] Condition"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
You remove the [[Prone]] Condition and take the [[Step]] Action.

<br>

While you are in the [[Content/Character Creation/Talents/Stance/Leaf Stance/Leaf Stance | Leaf Stance]], all Reaction Triggers become Free Triggers.