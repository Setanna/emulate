---
seconds: -1
traits:
 - link: "[[Reactive]]"
 - link: "[[Skill | Skill (Acrobatics)]]"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**Reaction Trigger:**  You are the target of an Action with the [[Attack]] or [[Blast]] Trait.
___

**System:**
You step out the way and Roll Acrobatics against the Attack Roll or Saving Throw Difficulty Check. For sources with the [[Blast]] Trait you take no damage if the [[Step]] or [[Move]] action would move you out of the blast radius.

<br>

**Critical Success:** The attack counts as a Miss and you take the [[Move]] Action. This Movement does not provoke [[Attack of Opportunity]].
**Success:** The attack counts as a Miss and you take the [[Step]] Action.
**Fail:** You reduce the damage taken by your Dexterity.
**Critical Fail:** You take full damage from the attack.


