---
resources:
  - name: Focus
    system: Whenever you take a [[Movement]] Action, you loose all your Focus Points. Additionally the maximum Focus Points you can spend on an Action is equal to your Dexterity.
  - name: Ki
    system: You regain an Expended [[Resources#Ki Points | Ki Point]] at the end of each of your turns and for each 2 Seconds spent on the [[Catch your Breath]] Action.
  - name: Rage
    system: At the end of each of your Turns you lose a Rage Point.
    traits:
     - link: Emotion
       value: (Anger)
  - name: Spell
    traits:
       - link: Arcane
---

# Resources
In Emulate, many Creatures have a wide variety of Resources they can use for their abilities.

```dataviewjs
await dv.view("_meta/Dataview/Components/resources");
```


