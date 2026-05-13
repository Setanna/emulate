---
tags: []
cssclass: pathfinder
---

# Armor
Armor reduces all [[Damage Types | Physical Damage]] and [[Damage Types | Elemental Damage]] by their Armor Value. A Creature can only benefit from one Armor Value at a time.

<br>

```dataviewjs
await dv.view("_meta/Dataview/Scripts/armor_tables");
```

**Dexterity Penalty:** While donned you reduce your Dexterity by the donned Armor's Dexterity Penalty.

**Maneuverability Penalty:** While donned you take an [[Rules/Traits/Item | Item]] Penalty to your [[Swim]], [[Rules/Stats and Skills/Skills/Strength/Climb | Climb]] and [[Fly]] Skills. The penalty is equal to the donned Armor's Maneuverability Penalty.

**Strength Requirement:** While donned, if you don't meet the donned Armor's Strength Requirement, you reduce your Speed by the Strength Requirement.

### Don and Doff
To gain the benefits of Armor it must be donned. It takes 1 minute to don light armor, 5 minutes to don medium armor and 10 minutes to don heavy armor. Another creature can help donning the armor, halving the time to don the armor.

<br>

Doffing the armor takes half the time it would take to don it. A creature can also help doff the armor, halving the time again.

<br>

If a creature is not Proficient in the given armor, double the time it would take to don or doff it.
