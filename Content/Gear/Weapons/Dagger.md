---
tags: []
cssclass: pathfinder
price: 30
weight: 0.6
damage_die: 4
damage_type: piercing
proficiency: Simple
type: Melee
traits:
  - link: Material
    value: (Steel)
  - link: Finesse
  - link: Light
  - link: Thrown
    value: (5m)
  - link: Vital Strike
---

```dataviewjs
await dv.view("_meta/Dataview/Components/weapon_title", {
    path: dv.current().file.path
});
```
<h1> Dagger <span style="margin-left: auto;">PRICE</span> </h1>

[[Finesse]]{.trait}

[[Light]]{.trait}

[[Thrown \| Thrown (10m)]]{.trait}

[[Versatile | Versatile (s)]]{.trait}

[[Vital Strike \| Vital Strike (D6)]]{.trait}

[[Material | Material (Steel)]]{.trait}

<div style="clear:both" /> 

<div style="margin-top:0.3rem"> 
	<div style="display:inline-block; float: left;"> 
		<b>Damage:</b> 1d4 Piercing
	</div> 
	<div style="display:inline-block; float: right; padding-right: 50px;"> 
		<b>Weight:</b> WEIGHT
	</div> 
	<div style="clear:both" /> 
</div>

___
*A thin, needle-like blade made for swift and precise thrusts.*


<br>

**Critical Effect:**
Increase the Damage from [[Vital Strike]] by one step.