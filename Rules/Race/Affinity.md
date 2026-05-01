---
tags: []
cssclass: pathfinder
affinities:
  "Major Positive Affinity":
    affinity: "++"
    adjustment: +2
  "Minor Positive Affinity":
    affinity: "+"
    adjustment: +1
  "Minor Negative Affinity":
    affinity: "-"
    adjustment: -1
  "Major Negative Affinity":
    affinity: "--"
    adjustment: -2
---

# Affinity

> [!warning] Work In Progress
> This has not been properly play tested

A creature that has a negative (-) or positive (+) Affinity to an Ability Score pays more or less XP for that Ability Score. 

The amount they is equal to the Ability Score times the Affinity Score. 

The Affinity Score is defined by the number of symbols (- or +'s).

Ability Score Affinities come in pairs, for each negative there is a positive. As such Affinities don't have an Experience Cost.

<br>

The following are the Ability Score XP Cost tables for the different Affinities:

##### Major Positive Affinity (++)
```dataviewjs
dv.view(
  "_meta/Dataview/affinity_cost_table",
  dv.current().affinities["Major Positive Affinity"]
);
```

##### Minor Positive Affinity (+)
```dataviewjs
dv.view(
  "_meta/Dataview/affinity_cost_table",
  dv.current().affinities["Minor Positive Affinity"]
);
```

##### Minor Negative Affinity (-)
```dataviewjs
dv.view(
  "_meta/Dataview/affinity_cost_table",
  dv.current().affinities["Minor Negative Affinity"]
);
```

##### Major Negative Affinity (--)
```dataviewjs
dv.view(
  "_meta/Dataview/affinity_cost_table",
  dv.current().affinities["Major Negative Affinity"]
);
```