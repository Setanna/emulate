---
tags: []
cssclass: pathfinder
costs:
  - name: minute
    xp: -450
  - name: puny
    xp: -300
  - name: tiny
    xp: -180
  - name: small
    xp: -90
  - name: short
    xp: -30
  - name: medium
    xp: 0
  - name: tall
    xp: 30
  - name: large
    xp: 90
  - name: towering
    xp: 180
  - name: huge
    xp: 300
  - name: gigantic
    xp: 450
---

# Size
Size modifies several things regarding a creature as noted in the table below:

| Size     | Height (m) | Weight (kg)  | Total XP Cost | Size Modifier | Reach | Speed | Move | Be Moved | Strength Rolls | Dexterity Rolls | Damage | Damage Reduction |
| -------- | ---------- | ------------ |:-------------:|:-------------:|:-----:|:-----:|:----:|:--------:|:--------------:|:---------------:|:------:|:----------------:|
| Minute   | 0.2 to 0.5 | 2 to 8       |     -450      |      -5       |   0   |  -2   |  -2  |    +2    |       -5       |       +5        |   -2   |        -2        |
| Puny     | 0.5 to 0.8 | 8 to 20      |     -300      |      -4       |   0   |  -2   |  -2  |    +2    |       -4       |       +4        |   -2   |        -2        |
| Tiny     | 0.8 to 1.1 | 20 to 45     |     -180      |      -3       |   1   |  -1   |  -1  |    +1    |       -3       |       +3        |   -1   |        -1        |
| Small    | 1.1 to 1.4 | 35 to 65     |      -90      |      -2       |   1   |  -1   |  -1  |    +1    |       -2       |       +2        |   -1   |        -1        |
| Short    | 1.4 to 1.7 | 55 to 90     |      -30      |      -1       |   1   |   0   |  0   |    0     |       -1       |       +1        |   0    |        0         |
| Medium   | 1.7 to 2   | 70 to 130    |       0       |       0       |   1   |   0   |  0   |    0     |       0        |        0        |   0    |        0         |
| Tall     | 2 to 2.3   | 140 to 250   |      30       |      +1       |   1   |   0   |  0   |    0     |       +1       |       -1        |   0    |        0         |
| Large    | 2.3 to 2.6 | 220 to 400   |      90       |      +2       |   1   |  +1   |  +1  |    -1    |       +2       |       -2        |   +1   |        +1        |
| Towering | 2.6 to 2.9 | 350 to 700   |      180      |      +3       |   2   |  +1   |  +1  |    -1    |       +3       |       -3        |   +1   |        +1        | 
| Huge     | 2.9 to 3.2 | 600 to 1,100 |      300      |      +4       |   2   |  +2   |  +2  |    -2    |       +4       |       -4        |   +2   |        +2        |
| Gigantic | 3.2 to 3.5 | 900 to 1,700 |      450      |      +5       |   2   |  +2   |  +2  |    +2    |       +5       |       -5        |   +2   |        +2        |

### Adding and Subtracting Size Modifier
Size Modifier is added to several elements in the Emulate System. To add a Size Modifier simply apply the given Size modifier to the given value. *(Negative Size modifiers reduce the given value)*

To Subtract a Size modifier reduce the given value by the Size modifier. *(Negative Size modifier increase the given value)*

<br>

**Reach**
Reach is not modified by Size Modifier. Instead directly refer to the given row for the given Size in the table above.

**Speed**
Add half your Size modifier rounded down to your Speed and the meters moved with the [[Step]] Action. This can not reduce the amount of meters moved below one.

<br>

**Move**
Whenever you would forcefully move a Creature, such as with the [[Ram]] or [[Shove]] Actions, add half your Size modifier rounded down to the meters the Creature is moved. 

<br>

**Be Moved**
Whenever you would be forcefully moved by a Creature, such a with the [[Ram]] or [[Shove]] Actions, subtract half your Size modifier rounded down to the the meters moved.

<br>

**Strength Rolls**
Add your Size Modifier to all Strength-Based Rolls and DCs.

<br>

**Dexterity Rolls**
Subtract your Size Modifier to all Dexterity-Based Rolls and DCs.

<br>

**Weapon Damage**
Whenever you would Roll for Weapon Damage, add half your Size modifier rounded down to the Damage Roll.

<br>

**Damage Reduction**
You reduce all damage by half your Size modifier rounded down.

<br>

**Carrying Loads**
Carrying Load is sized for Medium Creatures by default.
- Each size larger than Medium doubles all your Carrying Loads
- Each size smaller than Medium halves all your Carrying Loads by

<br>

**Gear**
Equipment is sized for Medium creatures by default.
- Each size larger than Medium doubles the cost and weight of armor, weapons, shields, and food
- Each size smaller than Medium halves the cost and weight of armor, weapons, shields, and food