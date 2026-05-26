---
seconds: 1 to 3
traits:
 - link: "[[Movement]]"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
*Flavor text*

**System:**
When leaping you can choose to do a Standing Leap or Running Leap. The height of your leap is 100 cm plus 10 times your Strength.

**Standing Leap (1 Second):**
With a Standing Leap you can move a number of metres equal to your Strength to a minimum of 1 meter.

**Running Leap (3 Seconds):**
You move up to your speed in a straight line and at the end of the movement you jump a number of meters equal to your Strength + half the number of meters moved.

**Size**
For each size above medium double the length and height of your jump. For each size below medium halve the length and height of your jump.