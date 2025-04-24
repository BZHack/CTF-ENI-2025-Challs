# Challenge
Le defi de Hellman

## Enonce
L'esprit malveillant Hellman prépare un mauvais coup, votre mission est de découvrir ce qu'il cache.

Vous avez réussi à intercepter un message mais vous n'arrivez pas à le déchiffrer. Il semblerait que Hellman utilise une méthode présente dans l'ouvrage 'Rivest Cipher volume 4' de Ronald Rivest.
En l'espionnant, vous avez découvert qu'il utilise un protocole pour échanger la clé qui sert à chiffrer le message. Cependant, sa clé privée semble laisser à désirer...

Vous avez retrouvé ces informations :
p = 2457653467875423
g = 5
clé public Hellman = 2011535723318929
clé public du complice = 691502255880305

Decoder le message suivant : 221c6263cf96c0538b32ca638ae0d368a4cd54a84d19
## Solution
la solution se trouve dans les deux scripts python

## Hints
- le protocole de chiffrement est le RC4
- il est possible bruteforce la clé privée de Hellman (trop peu sécurisée) pour ensuite générer la clé de déchiffrement