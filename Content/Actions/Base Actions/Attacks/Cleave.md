---
seconds: 4
traits:
 - link: Rules/Traits/Attack
   display: "Attack"
 - link: Daring
 - link: Rules/Traits/Item
   display: "Item (Melee Weapon)"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
___

**System:**
You choose a [[Areas#Cone | cone]] or [[Areas#Line | line]] with a range equal to your reach. You make a [[Making a Sweep | Sweep]] Attack with the given Area.

<br>

You take a -2 [[Circumstance]] Penalty on the [[Making a Sweep | Sweep]] Attack.
