---
seconds: 0
traits:
 - link: "[[Fate]]"
 - link: "[[Reactive]]"
free_action_triggers:
 - text: "When you are the Target of an Action or take an Action"
flavor_text:
 - text: "When you're face to face with death itself"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
When you use this action, you expend up to 3 Fate Dice. The triggering Action gains the follow benefit or penalty based on how many Fate Dice you expend:
- **1 Fate Die:** Add or Subtract a Fate Die from a Roll or Damage Roll
- **2 Fate Dice:** Roll an additional time for an Attack Roll, Skill Check or Damage Roll and choose the original or new result
- **3 Fate Dice:** Increase or Decrease Success by one step *(Critical Failure, Failure, Success and Critical Success)*

<br>

Using Twist of Fate does not count against your limit of one Reaction or Triggered Action per trigger.
You can use it alongside another Reaction or Triggered Action triggered by the same Action.
