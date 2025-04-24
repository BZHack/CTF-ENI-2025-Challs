# Challenge
L'Invocation Interdite

## Enonce
Dans les profondeurs de Black Hollow, un ancien grimoire a été découvert.
Selon la légende, un sorcier déchu, a laissé derrière lui une incantation cryptée, protégée par un sort mystique.

Mais une faille a été détectée... Il semblerait que le sorcier ait oublié de renforcer sa protection. 
Son invocation est vulnérable, exposant une précieuse clé à qui saura la récupérer.

## Solution
En analysant le PCAP on peut identifier des requetes Kerberos.
On peut voir qu'il y a deux requêtes à la suite KRB5 : AS-REP & AS-REP
Dans la requête AS-REP on peut retrouver le cipehr, dans KERBEROS -> as-rep -> enc-part 
Maintenant que nous avons le hash, pour le brute force il va falloir le mettre en forme.
etype : 23
CnameString : Lazarus.Wendigo
Pour hashcat il s'agira du mode 18200 (etype : 23): $krb5asrep$23$user@domain.com:32char$...
Une fois le hash en forme il ne reste plus qu'à le brute force avec hashcat

## Hints
https://blog.xpnsec.com/kerberos-attacks-part-2/