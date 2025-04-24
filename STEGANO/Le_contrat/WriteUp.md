# Challenge
    Le contrat
## Enonce
    Vous avez trouvé la page Nécronomicon mentionnant le contrat de Freddy Krueger.
    Vous sentez son énergie sortir de cette page, tenter de trouver ce qui s'y cache !
    
    exemple : ENI{FLAG_FORMAT}
## Solution
    Dans l'image il y a le mot FREDDY qui est caché, il servira de passphrase en utilisant steghide sur l'image.
    Pour extraire fichier texte il faut faire la commande suivante.
    steghide extract -sf necronomicon.jpg -p FREDDY*

    Dans le fichier, une image chiffrée en base64 sera a récupéré et à reconvertir en image.
    Dans l'image convertie, en bas à gauche se trouve le flag.
## Hints
  - "Tendez bien l'oreille"
  - "Une image peut en cacher une autre"