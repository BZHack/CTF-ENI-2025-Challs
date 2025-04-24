# Challenge
Ce challenge contient deux codes à déchiffrer pour obtenir le flag. Il se base sur le code de Vigenère pour la clé en langage ésotérique Piet.

## Résolution
Le premier est le drapeau chiffré, situé dans les métadonnées de l'image en commentaire.
Le second est l'image elle même, il s'agit d'un code PIET permettant une fois interprété d'obtenir la clé de déchiffrement du drapeau chiffré.

Le contexte du challenge permet d'orienter le joueur sur la piste du type de langage utilisé (Vigenère) et du major prussien qui à réussi a percer ce code au 19eme siècle.


## Hints

Obtenir le pass avec la commande strings sur le fichier
Déchiffrer la clé contenu dans l'image avec un interpréteur PIET en ligne comme https://gabriellesc.github.io/piet/ (Il suffit d'importer l'image et de lancer le débogueur sur la droite de la page) la clé apparait dans output = ENICTF
Décoder le message avec la clé en sélectionnant le type de chiffrement Vigenère sur Cyberchef avec la fonction Vigenère decode https://gchq.github.io/CyberChef/ Pass a déchiffrer = IAQ{EHIIIQIXSIEMGMHSQMRBJX} / Clé = ENICTF
Le flag est révélé !

## Conclusion

Ce challenge permet d'en apprendre plus sur l'imbrication de technique de chiffrement pour obtenir un message codé.
Drapeau : ENI{CODEVIGENEREETCODEPIET}