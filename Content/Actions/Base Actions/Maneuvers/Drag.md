---
tags: []
cssclass: pathfinder
seconds: 2
traits:
 - link: Maneuver
 - link: Movement
 - link: Skill
   display: "Skill (Athletics)"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```

**Requirements:** You are [[Grappled]] or [[Grappling]]

___

**System:**
You Roll [[Athletics]] against the creature you are [[Grappling]] or [[Grappled]] by. If you Roll against the creature [[Grappling]] you, the creature can end the condition before you Roll to not be moved, doing this counteracts the action and no seconds are spent.

<br>

**Critical Success:** You move the creature up to your speed. You may move with the creature.
**Success:** You move the creature one meter. You may move with the creature.
**Fail:** You fail to move the creature.

<br>

You must end your movement within the creature's reach if your [[Grappled]], or with the creature within your reach if you are [[Grappling]].
