# Challenge
Le code de Freddy

## Enonce
Tu es coincé dans le cauchemar. Freddy a verrouillé la seule issue avec un code insensé. Il n'y a aucun indice, aucune logique… Seulement une réponse, cachée dans l’ombre.
Tu pourrais errer éternellement dans ce labyrinthe, ou bien utiliser un esprit méthodique pour tracer le seul chemin possible vers la sortie.

## Solution
N'ayant pas les compétences pour créer un challenge bruteforcable sans être facilement patchable, ce challenge et sa solution ont été créés à l'aide de https://github.com/jakespringer/angr_ctf.
Les outils à utiliser sont un **désassembleur** (Ghidra, IDA, ...) et **angr** qui sera utiliser pour le bruteforce.
Ouvrez le binaire avec Ghidra (ou autre), ici on peut voir qu'il y a une comparaison entre deux chaînes de caractères dont l'entrée de l'utilisateur qui est modifié juste avant la comparaison. La fonction qui modifie la chaîne de caractères, `complex_function`, est complexe on ne peut pas trouver facilement le mot de passe en regardant seulement le code décompilé:
```C
int complex_function(int param_1,int param_2)
{
  if ((0x40 < param_1) && (param_1 < 0x5b)) {
    return (param_1 + -0x41 + param_2 * 3) % 0x1a + 0x41;
  }
  puts("Try again.");
  exit(1);
}
```
La comparaison entre les deux chaines de caractères:
```C
iVar1 = strcmp(entrée_utilisateur,"TJRXRJ");
```

La solution est de **donner à angr l'adresse que l'on veut atteindre** (l'affichage du flag) et l'outil bruteforcera la solution pour nous !
Pour cela, vous pouvez trouvez des templates en ligne ou des exemples dans la documentation d'angr. Dans ce Write-up j'utilise [ce template](https://github.com/jakespringer/angr_ctf/blob/master/solutions/00_angr_find/solve00.py) et je vais remplacer l'adresse à atteindre.
Pour trouver cette adresse, faites un clique gauche là où le flag est affiché. 
Dans la fenêtre qui affiche l'assembleur, regardez sur la gauche de cette fenêtre vous devriez voir l'adresse qui est  `0x804930f`:
```assembly
0804930f   CALL   <EXTERNAL>::printf     int printf(char * __format, ...)
```

Modifiez le script et exécutez le script python:
```bash
python3 resolve.py le_code_de_freddy
```

Cela devrait vous donnez le code `TGLOFU`. Donnez ce code au programme pour confirmer que c'est bien le flag:
```
$ ./le_code_de_freddy 
Enter the password: TGLOFU
Tu as gagné... mais Freddy reviendra toujours. Le flag est ENI{TGLOFU}
```

## Hints
- Le challenge doit être bruteforcé à l'aide d'Angr
- Il faut trouver l'adresse à atteindre à l'aide d'un désassembleur
- Utilisez ce template https://github.com/jakespringer/angr_ctf/blob/master/solutions/00_angr_find/solve00.py en modifiant l'adresse à atteindre
