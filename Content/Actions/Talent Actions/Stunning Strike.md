---
seconds: 0
traits:
 - link: Unarmed
 - link: Reactive
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**Free Trigger:** When you make an Attack

___
*Flavor Text*

<br>

**Cost:**
This action cost an additional 2 [[Rules/Mechanics/Resources/Ki | Ki]] Points to use.

**System:**
If you would deal damage, the defender makes a [[Saving Throws#Fortitude | Fortitude]] Saving Throw.

<br>

**Success:** The defender suffers no effect.
**Fail:** The defender gains the [[Slowed | Slowed 1]] Condition.
**Critical Fail:** The defender gains the [[Stunned | Stunned 1]] Condition.
