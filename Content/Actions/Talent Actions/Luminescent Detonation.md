---
seconds: -1
traits:
 - link: "[[Arcane]]"
 - link: "[[Reactive]]"
reaction_triggers:
 - text: "Whenever a creature within [[Lighting | Normal Lighting]] emitted of your Spell is the Target of an Attack Roll"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
*A snap of will turns your gathered light into a searing flash*

**System:**
You detonate the spell in a bright flash of light. The spell is counteracted and any creature within [[Lighting | Normal Lighting]] from the spell is affected by [[Lighting | Blinding Light]].

