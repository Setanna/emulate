---
seconds: 1
traits:
 - link: Focus
 - link: Skill
   display: "Skill (Knowledge)"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
___
*You know just where to strike them to make it hurt.*

<br>

**System:**
You Roll the relevant [[Knowledge]] Roll as shown in the table below.



| Creature Type                         | Knowledge Category |
| ------------------------------------- | ------------------ |
| Constructs; dragons; magical beasts   | Arcana             |
| Humanoids                             | Local              |
| Animals; fey; monster; plants; vermin | Nature             |
| Outsiders                             | Planes             |
| Undead                                | Religion           |

<br>

**Critical Success:** You learn everything there is to know about the creature.
**Success:** Your learn the creatures special powers; resistances; and vulnerabilities.
**Fail:** You recall nothing and can't Roll against the same creature.