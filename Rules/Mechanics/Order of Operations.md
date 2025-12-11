---
tags: []
cssclass: pathfinder
---

# Order of Operations
Several effects in Emulate can multiply, subtract or otherwise change a given numerical value.  When several effects change a numerical value in different way, the following document describes how to properly apply these changes in the correct order.

##### 1. Multiply and Divide
The first order of operation is to multiply the value by the given multiplier. Then afterwards you divide it by the given denominator and round up to the nearest whole number.

If there are several multipliers or denominators, combine them before multiplying or dividing.

##### 2. Addition and Subtraction
The second order of operation is to add the positive modifiers and then the negative modifiers.

##### 3. Maximum and Minimum
The third order of operation is to determine any maximum or minimum given. If a maximum or minimum is given, the final value cannot exceed the given maximum or drop below the given minimum.