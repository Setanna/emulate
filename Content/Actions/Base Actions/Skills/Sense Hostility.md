---
seconds: 1
traits:
 - link: "[[Focus]]"
 - link: "[[Skill | Skill (Insight)]]"
requires:
 - "You are not in an [[Encounters | Encounter]]"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
*Flavor text*

**System:**
You Roll Insight against any number of creatures Bluff DC. Rolling against a creature that is in no way hostile or planning any form of attack automatically, counts as a Fail.

**Critical Success:** You gain a +4 [[Circumstance]] Bonus to your next Initiative Roll against that creature until your next preparation.
**Success:** You gain a +2 [[Circumstance]] Bonus to your next Initiative Roll against that creature until your next preparation.
**Fail:** You fail at noticing any immediate hostility.
**Critical Fail:** You misjudge the moment of attack. You gain a -2 [[Circumstance]] Penalty  to your next Initiative Roll against that creature until your next preparation.