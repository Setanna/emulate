---
seconds: 1 to 5
traits:
---

```dataviewjs
await dv.view("_meta/Dataview/Components/action_title", {
    path: dv.current().file.path
});
```
___

**System:**
You do an action that interacts with an object or another. Some actions might require one to move to properly do the action, such actions gain the [[Movement]] Trait.


| Task                               | Cost      | Roll | [[Attack of Opportunity]] |
| ---------------------------------- | --------- | ---- |:-------------------------:|
| Light a Torch                      | 6 Seconds | None |             ✔             |
| Open a Door                        | 1 Second  | None |             ✔             |
| Flip a Table                       | 3 Seconds | None |             ✔             |
| Get something from a [[Bandolier]] | 0 Seconds | None |            ❌             |
| Get something from a [[Pouch]]     | 1 Second  | None |            ❌             |
| Get something from a [[Bag]]       | 3 Seconds | None |             ✔             |
| Barricade Door                     | 6 Seconds | None |             ✔             |
| Active Magic Item                  | Varies    | None |            ❌             |
| Unsheathe or Sheathe a weapon      | 1 Second  | None |            ❌             |
| Grip weapon with two hands         | 0 Seconds | None |            ❌             |
| Remove hand from weapon            | 0 Seconds | None |            ❌             |
| Drop something                     | 0 Seconds | None |            ❌             |

