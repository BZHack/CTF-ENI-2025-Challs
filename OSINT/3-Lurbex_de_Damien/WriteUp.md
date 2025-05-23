# Challenge

L'urbex de Damien (3/6)

## Enonce

Damien est parti en urbex avec un autre passionné. Une fois sur place, il a envoyé un message à Simon pour qu'il les rejoigne : 
_"Simon, j'explore un lieu super. Rejoins-nous. Lola te mènera à François, tu trouveras le lieu à environ 6 km de là."_

En quelle année François a t'il cessé son activité ? 
Qui a racheté en 1864 le lieu exploré par Damien ?

## Solution

Le message de Damien est assez mystérieux. Il parle de Lola, de François et d'un lieu à 6 km environ . Une photo est également jointe. Commençons par elle. En faisant une recherche inversée sur Google Lens, nous trouvons plusieurs résultats (certains n'ont obtenu aucun résultat sur Chrome, elkle reste tributaire du comportement du site) : la première est indiquée à La Montagne (Couëron), une autre au Pellerin, une autre à Indre. Si on vérifie sur Maps, nous avons trois églises à Couëron (mais pas à La Montagne même), dont aucune ne correspond pas, une au Pellerin, en pierres blanches (ce qui n'est pas le cas de celle de la photo). La dernière, à Indre, correspond à notre église. Nous trouvons d'autres photos sur Wikipedia ([Page Wikipedia d&#39;Indre](https://fr.wikipedia.org/wiki/Indre_(Loire-Atlantique)#.C3.89glise_Saint-Hermeland)), qui confirment qu'il s'agit de cette église.

![image](src/resultats_recherche_google_lens.png)

![image](src/eglise_saint_hermeland_indre.jpg)

Intéressons nous à Lola. Faisons une recherche sur un moteur de recherche. Que ce soir sur Google ou Qwant, les mots-clés "Lola Indre" nous donnent des résultats intéressants. Lola est le nom d'un bac faisant la liaison entre Indre (commune où se situe l'église en photo) et Indret.

![image](src/recherche_lola_indre.png)

![image](src/article_lola.png)

Sur la [page Wikipedia traitant des bacs de Loire](https://fr.wikipedia.org/wiki/Bacs_de_Loire), nous avons également mention de Lola. Nous avons une autre information intéressante : un ancien bac s'appelle François II.

![image](src/article_wikipedia_bacsdeloire.png)

En regardant plus intensément la page Wikipedia, nous apprenons que le François II a été mis en service en 1962 et remplacé en 2012 par Lola (nous avons la réponse à la première question). Si Lola nous mènera à François et qu'il fait la liaison entre Indre et Indret, jetons un oeil du côté d'Indret. Nous retrouvons le François II à quai.

![image](src/bac_francois-II_indret.jpg)

Le lieu d'exploration serait à environ 6 km du François II. En faisant une recherche des lieux d'urbex dans la Loire Atlantique, nous obtenons quelques résultats sur [Urbexe.com](https://www.urbexe.com/france/pays-de-la-loire/loire-atlantique/). Beaucoup sont trop loin. Nous avons un aéroport abandonné et un "château Bougon" à Bouguenais qui pourraient correspondre. En recherchant le château Bougon et en faisant une mesure, nous obtenons 5m89 depuis le quai du bac.

![image](src/chateau_bougon.jpg)

Nous avons également une information complémentaire : Damien a, comme sa soeur, un compte sur [journalintime.com](https://dbw.journalintime.com/). Il a posté un message le 11/03 indiquant qu'il allait bientôt partir en urbex pour explorer un château abandonné du XIXè siècle. Cette information restreint encore la liste et Château Bougon semble correspondre.

![image](src/post_journal_damien.png)

Faisons une parenthèse pour détailler le pivot vers ce compte, qui n'a pas encore été utilisé. Victoria Birdwood, la soeur de Damien, a posté sur Bluesky qu'elle avait un compte sur ce site. Une personne a aimé ce post : Damien. Cette information subtile doit pousser à s'interroger sur la possibilité pour Damien d'avoir lui aussi créé son compte.

![image](src/message_journal_intime_victoria.png)

Pour tenter de trouver ce compte, nous pouvons essayer avec son pseudo Bluesky, à savoir damienbw.journalintime.com. Ce compte n'existe pas sur le site. Toutefois, il est courant qu'une personne utilise différents pseudos selon le site. Nous voyons dans sa présentation Bluesky qu'il signe "@dbw". Si nous utilisons cette "signature", nous trouvons [https://dbw.journalintime.com/](https://dbw.journalintime.com/), d'un certain Dam. Nous retrouvons un message sur le film trouvé chez son grand-père et l'urbex, confirmant que nous sommes au bon endroit.

Retournons sur notre recherche principale. Recherchons un peu d'information sur Château Bougon. En utilisant les mots-clés "chateau bougon histoire", nous trouvons plusieurs résultats nous apprenant que le propriétaire à la fin du 19è siècle était Paul Renaud.

![image](src/resultats_recherche_google_chateau_bougon_histoire.png)

Le flag est donc ENI{2012_PAUL_RENAUD}.

## Hints
