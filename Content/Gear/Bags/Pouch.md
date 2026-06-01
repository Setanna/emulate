---
price: 12
traits:
- link: "[[Bag]]"
flavor_text:
- text: "A modest leather pouch, reliable and always at your side"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/gear_title", {
    path: dv.current().file.path
});
```

**System:**
A Pouch can hold any small item.

<br> 

Retrieving an item from the Pouch is an [[Interact]] Action for 1 Second and does not provoke attack of opportunity.
