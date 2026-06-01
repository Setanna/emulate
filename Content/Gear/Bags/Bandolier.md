---
price: Varied
traits:
- link: "[[Bag]]"
flavor_text:
- text: "_A leather strap arcs from shoulder to waist, pouches snug along its length_"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/gear_title", {
    path: dv.current().file.path
});
```

**System:**
A Bandolier can be made to specifically hold differenct objects as shown in the table below:

| Stored Item         |  CC  | Amount                                                                    |
| ------------------- |:----:| ------------------------------------------------------------------------- |
| Potions and Poisons |  34  | Can hold up to 12 potions or poisons                                      |
| Throwing Knives     |  22  | Can hold up to 24 Throwing Knives                                         |

<br> 

Retrieving an item from the Bandolier is an [[Interact]] Action for 0 Seconds and does not provoke attack of opportunity.
