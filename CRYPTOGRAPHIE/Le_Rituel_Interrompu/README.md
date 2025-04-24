# Challenge creation rules

## Ecriture Write-Up

**Important!** : Il faut partir du principe que ce n'est pas vous qui allez aider le joueur mais un autre Helper. Ne pas hésiter à être clair.

Pour l'écriture d'un Write-Up, il est important de:
1. Remettre l'énoncé
2. Etre clair dans l'utilisation des ressources et tools
3. Il est préférable de mettre des hints propre aux Helpers au cas où ce ne soit pas vous qui aidez.

*bonus*: si possible mettre un `solve.py` pour permettre a un helper de tester si le challenge fonctionne toujours. (python a privilégier mais autre possible)

|fichiers|roles|
|:--|:--|
|challenge.yml|fichier de déploiement pour le ctfd|
|WriteUp.md|fichier de solution du challenge|
|src/|répertoire pour les sources du challenge|

## Challenge.yml

Le fichier de challenge est au format YAML et il a pour objectif de permettre le déploiment facile et rapide des challenges.

Pour le bon déroulement du CTF, il est soumis a plusieurs règles:
1. Il doit toujours avoir le nom `challenge.yml` et se localiser à la racine du répertoire du challenge.
2. Il doit comporter au minimum les sections:
   1. name
   2. author
   3. category
   4. description
   5. (valeur des points)
   6. flags
   7. tags
   8. state
3. La valeur des points doit être identique à celle défini pour l'ensemble du CTF
4. Le flag est unique et doit comprendre uniquement les caractères suivants : [a-z][A-Z][0-9][-_$!&@/]
5. Les fichiers importé dans le challenge doivent impérativement se trouver dans `src/`
6. Le tags est unique et doit correspondre au niveau de difficulté défini pour l'ensemble du CTF
7. Les urls des challenges est au format: `https://<nom du chall>.eni.fr:<port>/<path>`. <port> et <path> sont optionnel et leurs valeurs par défaut sera: port:443 et path:/
8. Les hints sont public aux joueurs. Ne pas mettre de hint permettant de facilement résoudre le challenge

## WriteUp.md

Le fichier de Write-Up est au format Markdown et a pour objectif de permettre aux Helper d'aider les joueurs.

Pour le bon déroulement du CTF, il est soumis a plusieurs règles:
1. Il doit toujours avoir le nom `WriteUp.md` et se localiser à la racine du répertoire du challenge.
2. Il doit comporter au minimum les sections:
   1. *

## src/

Ce répertoire héberge l'ensemble des resources liée au challenge.

Pour le bon déroulement du CTF, il est soumis a plusieurs règles:
1. Il doit toujours avoir le nom `src/` et se localiser à la racine du répertoire du challenge.
2. Il comporte un sous-répertoire `src/public/` pour les fichiers à mettre dans le challenge.
