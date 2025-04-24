# Challenge
La Condition de Michael Myers

## Enonce
Michael Myers est inarrêtable… Toujours là, encore et encore. Peut-être qu’un simple détail pourrait enfin le faire disparaître ?

## Solution
L'outil à utiliser est un désassembleur (Ghidra de préférence). 
Si on exécute le binaire sans le modifier, il affiche le message "Michael Myers rôde toujours...". Une fois le binaire ouvert dans Ghidra, on peut voir le message "**/* WARNING: Removing unreachable block (ram,0x001013cd) */**" au-dessus de la fonction main. 
Pour corriger ce problème, cliquez sur le bouton "**Toggle off to eliminate unreachable code**" qui se situe dans la barre en haut de la fenêtre qui affiche le pseudo-code, à droite des deux flèches vertes. Ce message s'affiche car le programme est une boucle "if" qui est tout le temps à false donc une branche n'est jamais exécutée donc Ghidra choisit de ne pas l'afficher. 
Le pseudo-code du binaire est le suivant :
```bash
if (true)
  Affiche "Michael Myers rôde toujours..."
else
  Affiche "Il a disparu dans l'ombre... mais il a laissé quelque chose derrière lui.\n"
  Affiche le flag
```

Il y a deux solutions, la plus compliquée est de remarquer que la fonction "affiche_flag" déchiffre le flag en utilisant AES donc on peut trouver les paramètres utilisés qui sont en clair dans le binaire et déchiffrer le flag comme ça. 
**Le plus simple est de patcher le binaire pour transformer ce "if false" en "if true"**, ce qui affichera le flag. Pour patcher le binaire, dans la fenêtre qui affiche le pseudo-code, cliquez sur "if (false)". 
En faisant ça, la fenêtre qui affiche l'assembleur va se mettre à l'adresse `001013cb` et vous afficher le code assembleur associé. 
Ce code devrait être le suivant :
```assembly
JZ        LAB_001013e1
```
L'instruction `JZ` signifie de faire un saut (aller à) à la fonction `LAB_001013e1` (la fonction qui affiche le flag) si la comparaison faite au-dessus est égale à 0. Sauf que dans notre cas, ce n'est pas le cas. 
**Ce qu'on veut c'est l'inverse donc on va transformer ce `JZ` en `JNZ`** (comparaison différente de 0). 
Pour patcher le binaire, faites un clic droit sur `JZ` puis sélectionnez "Patch Instruction" et remplacez `JZ` par `JNZ`. Si vous avez bien effectué la manipulation, le pseudo-code a changé : la condition "if false" est devenue "if true". 
Pour finir, exportez le binaire patché en cliquant sur "File" en haut à gauche -> "Export Program" -> pour le format choisissez "Original File" et choisissez l'endroit où vous souhaitez enregistrer le binaire modifié, ensuite finissez par cliquer sur "OK". 
Enfin, exécutez le binaire patché, le flag devrait apparaître:
```
Il a disparu dans l'ombre... mais il a laissé quelque chose derrière lui.
Le flag est ENI{la_fin_du_cauchemar}
```

## Hints
- Le programme compilé est une simple boucle if, si vous ne la voyez pas cliquez sur "Toggle off to eliminate unreachable code" dans la fenêtre qui affiche le pseudo-code
- Il faut patcher la condition de la boucle "if" pour résoudre ce challenge
- Remplacez la condition "JZ" en "JNZ" à l'adresse 001013cb, exportez le binaire puis exécutez le
