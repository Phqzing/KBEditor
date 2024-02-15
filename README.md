# Download 
[![](https://poggit.pmmp.io/shield.dl/KBEditor)](https://poggit.pmmp.io/p/KBEditor)
<a href="https://poggit.pmmp.io/p/KBEditor"><img src="https://poggit.pmmp.io/shield.dl/KBEditor"></a>

# KB EDITOR
Change the Knoback values of world or the entire server to your liking!

# Config / Settings
```yml
---
# if this is true the Knockback will only be applied to players but if it's false it will also apply to other entities
only-players: true
 
# this Knockback values will be applied to all the worlds that is not specified in "world-kb"
general-kb:
  horizontal: 0.4
  vertical: 0.4
  attack-speed: 10

# NOTE: "attack-speed" must be a whole number and must not include a decimal point
# FORMAT:
# 
# world-kb
#   worldname:
#     horizontal: 0.4
#     vertical: 0.4
#     attack-speed: 10
world-kb:
  worldNameExample:
    horizontal: 0.37
    vertical: 0.37
    attack-speed: 10
  anotherExample:
    horizontal: 0.25
    vertical: 0.25
    attack-speed: 2
...
```

# Features
- Can change the values of each world
- Can change the attack cooldown/attack speed
- Can work on other entities if you want to (set the "only-players" value in the config to false)

# TODO (0.1.1)
- [ ] Add in-game GUI for better customization
- [ ] Add per player KB
- [ ] Think of more ideas (feel free to suggest your ideas!)