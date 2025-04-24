# Challenge
L'Infiltration des Ombres

## Enonce
    Des rumeurs sinistres entourent l'ancienne station de travail d'un certain Edgar Ravenscroft, un administrateur système ayant disparu dans des circonstances mystérieuses.
    Selon les légendes, son poste de travail serait un lieu de terreur où des événements inexplicables ont eu lieu.
    Avant sa disparition, Edgar a accédé à un partage SMB sur un serveur oublié, laissant derrière lui une trace de son passage.
    Ce partage renferme des secrets dont certains devraient rester cachés à jamais.

    Retrouvez son mot de passe pour accéder au partage.

## Solution

Récupération du hash : https://apackets.com/
copie du hash dans hash.txt
hashid hash.txt -> NetNTLMv2
hashcat -m 5600 hash.txt /usr/share/wordlist/rockyou.txt

## Hints
Analyse PCAP online : https://apackets.com/
NTLMSSP