# Challenge
Le Rituel Interrompu

## Enonce
Dans les sous-sols du manoir de Ravenscroft, un grimoire ancien a été découvert. Il renferme un message chiffré, gravé dans le sang sur un parchemin en peau humaine.
Selon les archives occultes, ce message devait être lu à voix haute lors d’un rituel interdit… mais le rituel a été brutalement interrompu. 
Dans la précipitation, les initiés ont réutilisé un élément chose pour générer plusieurs clés RSA différentes. 
Une grave erreur qui pourrait permettre à un intrus de briser leur cryptographie et révéler leur sombre secret…

## Solution
Dans le fichier encrypted_fragment.txt on peut voir qu'il y a deux message c1 & c2.
En analysant les clés public, on peut découvrir qu'il y a un facteur commun.
Il existe une attaque permet de déchiffrer le message, elle nécessite d'avoir le module n commun au deux clés, les exposants e et les messages c1 & c2.
Pour que l'attaque fonctionne, il faut aussi que les exposants soient coprimes.

Le script decrypt.py dans le répertoire /src permet de résoudre le chall.
## Hints
Analyse des clés public avec : https://lapo.it/asn1js/
Exemple d'attaque de facteur commun : https://medium.com/bugbountywriteup/rsa-attacks-common-modulus-7bdb34f331a5