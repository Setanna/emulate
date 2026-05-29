---
value:
 min: 1
 max: 3
traits:
 - link: "[[Sight]]"
flavor_text:
 - text: "A single scar draws eyes. A face full turns them away"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/affliction_title", {
    path: dv.current().file.path
});
```

**System:**
You gain the [[Ugly]] Characteristics. For each level of this Impairment higher than one, increase the Bonus from [[Ugly]] by one.

<br>

For each level of this Impairment, choose what part of your body the scars are visible one:
- **Head:** Hidden by helmets and scarves
- **Torso:** Hidden by shirts and similar
- **Left Arm:** Hidden by long sleeved shirts and gloves
- **Right Arm:** Hidden by long sleeved shirts and gloves
- **Left Leg:** Hidden by long legged pants and shoes
- **Right Leg:** Hidden by long legged pants and shoes

<br>

> ##### Example
> 1. A Human with the Scars 1 Impairment chooses scars on the Head.
> 2. His scars, narratively, come from the betrayal of his friend who tried to slit his throat.
> 3. This scar can only be hidden by scarves or helmets covering his neck.
