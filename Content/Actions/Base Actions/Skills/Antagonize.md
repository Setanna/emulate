---
seconds: 1
traits:
 - link: "[[Emotion | Emotion (Anger)]]"
 - link: "[[Sight]]"
 - link: "[[Language]]"
 - link: "[[Skill | Skill (Intimidate, Diplomacy or Bluff)]]"
 - link: "[[Timed]]"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
*“I didn’t insult you. I described you.”*
*— Marrow the Unpleasant*

**System:**
Choose a Creature to direct hostility towards. This creature will be called the Scapegoat.

Choose any number of Creatures. Choose [[Diplomacy]], [[Bluff]] or [[Intimidation]], then Roll against each Target’s Will DC. The following conditions can modify the Target's Saving Throw:
- If the Scapegoat is an Ally to the Target, the Target gains a +5 [[Circumstance]] bonus to it's Saving Throw.
- If a target cannot see you, they treat this Action as lacking the [[Sight]] Trait. The Target gains a +3 [[Circumstance]] bonus to its Saving Throw.
- If a target cannot hear you or speak your Language, they treat this Action as lacking the [[Language]] Trait. The Target gains a +3 Circumstance bonus to its Saving Throw.

**Critical Success:** The creature gains the [[Provoked | Provoked 2 (Scapegoat)]] Condition.
**Success:** The creature gains the [[Provoked | Provoked 1 (Scapegoat)]] Condition.
**Fail:** You fail to provoke the Enemy.
**Critical Fail:** You gain the [[Provoked | Provoked 1 (Target)]] Condition.


