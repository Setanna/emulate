---
value:
  min: 1
  max: 10
traits:
- link: "[[Emotion | Emotion (Fear)]]"
flavor_text:
- text: "A lingering fog or creepy woods"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/environment_modifier_title", {
    path: dv.current().file.path
});
```

**System:**
Any creature that enters the area must makes a [[Saving Throws#Will | Will]] Saving Throw with a DC equal to 10 + this modifier's Level. A creature can only make this Saving Throw once per [[Resting#Preparation | Preparation]].

<br>

**Success:** The creature is not affected by this Environment Modifier
**Failure:** The creature is [[Frightened | Frightened 1]]
**Critical Failure:** The creature is [[Frightened | Frightened 2]]