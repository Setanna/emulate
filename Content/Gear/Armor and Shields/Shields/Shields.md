---
tags: []
cssclass: pathfinder
---

# Shields
Shields increase a Creature's Armor Value by it's Shield Value.

```dataviewjs
await dv.view("_meta/Dataview/Scripts/shield_tables");
```

<br>

**Dexterity Penalty:** While donned you reduce your Dexterity by the donned Shields's Dexterity Penalty.

<br>

**Maneuverability Penalty:** While donned you take an [[Rules/Traits/Item | Item]] Penalty to your [[Swim]], [[Rules/Stats and Skills/Skills/Strength/Climb | Climb]] and [[Fly]] Skills. The penalty is equal to the donned Shield's Maneuverability Penalty.

<br>

**Strength Requirement:** While donned, if you don't meet the donned Shield's Strength Requirement, you can't take any Reactions using the Shield.

### Don and Doff
To gain the benefits of a Shield it must be donned. It takes 2 Second to don light shields, 4 Seconds to don medium shields and 6 Seconds to don heavy shields. 

<br>

Doffing a Shield, takes half the time it would take to don it.

<br>

If a creature is not Proficient in the given Shield, double the time it would take to don or doff it.
