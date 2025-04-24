# Challenge
Les Secrets de l'Annuaire

## Enonce
L'Active Directory, ce vaste annuaire où résident les secrets les plus sombres d'une organisation, a été compromis.
Une capture réseau a été interceptée, révélant les résultats d'une énumération LDAP effectuée sur un serveur d'Active Directory.
Cette capture regorge d'informations sensibles, y compris des attributs d'utilisateurs qui, pour les yeux avertis, dissimulent des informations clés.

Les administrateurs du domaine n'ont pas pris la peine de sécuriser leurs annuaires correctement.
Ils ont laissé des traces dans les attributs des utilisateurs, et vous avez été choisi pour explorer ces données afin de récupérer ce qui est caché.

## Solution
Recherche du flag dans les attributs.
Sur un paquet LDAP : clic droit -> suivre -> TCP Flux
info1 : Rmw0Z19TM2NyZVRfM251TQ==
from base Rmw0Z19TM2NyZVRfM251TQ==
ENI{Fl4g_S3creT_3nuM}
## Hints