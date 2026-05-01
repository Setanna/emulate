---
tags: []
cssclass: pathfinder
traits:
 - link: Size
   display: Medium
   css: size-trait
 - link: Humanoid
purchases:
 - link: Human
 - link: Scars
   level: 3
 - link: Brave
 - link: Calm
 - link: Indomitable
 - link: Pain Tempered
 - link: Survivor
 - link: Scars Endure
 - link: Skill Proficiency
   display: Skill Proficiency (Athletics)
 - link: Skill Proficiency
   display: Skill Proficiency (Perception)
 - link: Skill Proficiency
   display: Skill Proficiency (Insight)
 - link: Skill Proficiency
   display: Skill Proficiency (Intimidation)
 - link: Light Armor Proficiency
 - link: Medium Armor Proficiency
 - link: Heavy Armor Proficiency
 - link: Simple Weapon Proficiency
 - link: Advanced Weapon Proficiency
 - link: Full Plate
 - link: Battleaxe
 - link: Battleaxe
ability_scores:
 - strength: 
      score: +4
      affinity: "Minor Negative Affinity"
 - dexterity: 
      score: +2
 - constitution: 
      score: +3
 - intelligence: 
      score: +1
 - wisdom: 
      score: +2
 - charisma: 
     score: +3
---

```dataviewjs
const { calculateXP } = await import(
    app.vault.adapter.getResourcePath("_meta/Dataview/calculate_xp.js")
);

let page = dv.current();
const { total, rows } = await calculateXP(page, dv);

page.xp = total;

page.rows = rows;

dv.view("_meta/Dataview/xp_title", page);
dv.view("_meta/Dataview/traits", dv.current());
```

___

**Initiative:** +2; **Senses:** Perception +2

![[grim_jester.jpg]]{.thumbnail}

___

**Armor Value:** 9 ([[Content/Gear/Armor and Shields/Armor/Armor | Full plate]] ([[Bulwark | Bulwark 3]]))
**Hit Points:** 11 (1d8 + 3)
**Fort:** +3, **Ref:** 0, **Will:** +2
- +3 against [[Emotion | Emotion (Fear)]]
- +6 against [[Emotion | Emotion (Pain)]]

___

**Speed:** 5 meters
**Melee:** 
- Battleaxe: +4 to Hit; 1d8 + 4 Slashing
- Battleaxe: +4 to Hit; 1d8 + 4 Slashing
- [[Multiattack]] (4 Seconds)

**Space:** 1 meter.; **Reach:** 1 meters


___

**Str** +4, **Dex** 0 (+2), **Con** +3, **Int** +1, **Wis** +2, **Cha** +3
**Skills:** Athletics +4; Perception +2; Insight +2; Intimidation 3+
**Languages** Common

### Typical Actions
The Grim Jester uses the [[Intimidate]] Action to unsettle his opponents before charging into Melee while dual wielding Battleaxes. The Grim Jester holds no value to his own life and fights until death.

# XP Distribution

```dataviewjs
const { calculateXP } = await import(
    app.vault.adapter.getResourcePath("_meta/Dataview/calculate_xp.js")
);
const { createXPTable } = await import(
    app.vault.adapter.getResourcePath("_meta/Dataview/xp_table.js")
);

let page = dv.current();

const { total, rows } = await calculateXP(page, dv);

createXPTable(total, rows, dv);
```