---
price:
  min: 100
  max: 500
traits:
- link: "[[Worn#Eyes| Worn (Eyes)]]"
flavor_text:
- text: "For those whose eyes can’t be trusted beyond the tip of their nose"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/gear_title", {
    path: dv.current().file.path
});
```

**System:**
While wearing Glasses, you treat [[Murksight]] as being a lower level. For each Silver Coin spend on the Glasses up to 5 Silver Coins, you reduce the [[Murksight]] level by one.

<br>

If you don't have [[Murksight]], you instead gain [[Murksight]] with a level equal to the amount of Silver Coins spend on the Glasses.


