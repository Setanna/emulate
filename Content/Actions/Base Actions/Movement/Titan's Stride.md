---
seconds: 1
traits:
 - link: "[[Movement]]"
requires:
 - "Both hands free"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
*The world's burden on your shoulders*

**System:**
You lift an object or willing creature weighing greater than your [[Stats#Physical | Heavy Load]] to a maximum of twice your [[Stats#Physical | Heavy Load]]. While carrying this object both your hands are occupied and you gain the [[Flat-Footed]] Condition.

While carrying anything using this Action,you can only use a seconds to put down the object or take the [[Step]] Action. *You still incur any Heavy Load Penalties such as increased movement cost*. Taking the [[Step]] Action in this way it provokes attack of opportunity. Additionally, Each turn where you've carried something using this Action, you gain the [[Fatigued | Fatigued 1]] Condition.

