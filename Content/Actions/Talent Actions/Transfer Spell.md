---
seconds: 1
traits:
 - link: "[[Arcane]]"
requires:
 - "You are under the effects of one or more Spells"
flavor_text:
 - text: "As your light dims, you pass the spell on, a promise the battle isn't lost"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**System:**
You choose one Spell of which you are currently effected by. You transfer the chosen Spell to another a valid target for the Spell within range of the Spell or within reach if the Spell's range is personal. The target get's all the effects of the Spell as if the Spell was originally cast on them.

