---
seconds: -2
traits:
requires:
 - "You or your ally within Reach is [[Burning]]"
 - "You have a hand free"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
You quickly douse the flames on your body. For each Second spent, reduce the Fire Damage Die by one step. If using two hands reduce the Fire Damage Die by two steps for each Second spent.

<br>

You can use this action on an ally within your Reach.





