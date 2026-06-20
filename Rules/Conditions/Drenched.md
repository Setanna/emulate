---
flavor_text:
 - text: "Soaked through"
---

```dataviewjs
await dv.view("_meta/Dataview/Components/condition_title");
```

**System:**
When you move in a dry environment while you have the Drenched Condition, all Creatures gain a [[Circumstance]] Bonus on track you. The Bonus is equal to the Maximum of your Drenched Condition Value.

If you would gain the Drenched condition with a different Liquid, they [[Counteracting | counteract]] each other.

You gain additional benefits or penalties dependant on the Liquid in your Drenched Condition as shown below:

## Liquids
Your Drenched Condition can have any of the following Liquids:

### Water
While you have the Drenched (Water) Condition you gain the following effects:
- You take a [[Circumstance]] Bonus on Saving Throws against effects with the [[Fire]] Trait
- You take a [[Circumstance]] Penalty on Saving Throws against effects with the [[Cold]] or [[Electricity]] Trait.
- You reduce [[Damage Types#fire | Fire]] Damage
- You increase [[Damage Types#Cold | Cold]] and [[Damage Types#Electricity | Electricity]] Damage

Any increase, reduction, penalty or bonus are based on your Drenched (Water) Condition's Value.

Additionally Drenched (Water) [[Counteracting | counteracts]] the [[Burning]] Condition.

### Holy Water
You gain all the effects of Drenched (Water) but also at the start of each your turns you take [[Damage Types#Radiant | Radiant]] Damage equal to your Drenched (Holy Water) Condition's Value.

### Unholy Water
You gain all the effects of Drenched (Water) but also at the start of each your turns you take [[Damage Types#Necrotic| Necrotic]] Damage equal to your Drenched (Unholy Water) Condition's Value.

### Oil
While you have the Drenched (Oil) Condition you gain the following effects:
- You increase [[Damage Types#fire | Fire]] and [[Damage Types#Cold | Cold]] Damage
- If you would take [[Damage Types#Electricity | Electricity]] Damage or be affected by an [[Electricity]] Action, you remove your Drenched (Oil) Condition and gain the [[Burning]] Condition.

Any increase or Condition Value is based on your Drenched (Oil) Condition's Value.

### Acid
You can be drenched by a wide variety of Acids each with their own unique names. At the start of your turn you gain the Drenched Effect written on the Acid you are Drenched by.

Drenched (Acid) is also [[Counteracting | counteracted]] by any other Drenched (Acid) from another Acid.
