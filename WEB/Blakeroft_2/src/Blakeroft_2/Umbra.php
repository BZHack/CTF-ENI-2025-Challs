<?php
    require_once 'session.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blakeroft - Envoyer un Email</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>

<body>
    <header>
        <h1>Blakeroft</h1>
        <nav>
            <ul>
                <li><a href="/">Accueil</a></li>
                <li><a href="grimoire.php">Grimoire</a></li>
                <li><a href="#">Umbra</a></li>
                <?php if (!empty($Firstname) && ($Firstname != "Unknown" || $Lastname != "Unknown")) {
                    echo '<li><span class="green-box">Bonjour ' . htmlspecialchars($Firstname) . '</span></li>'; 
                } else { 
                    echo '<li><span class="red-box">Non authentifié</span></li>';
                } ?>                
            </ul>
        </nav>
    </header>

    <main class="main-background-umbra">
        <div class="content-wrapper">
            <div class="hero">
                <h2>Umbra, l'ombre salvatrice<br></h2>
            </div>
            <div class="info">
                <?php if ($Lastname== "Dreadmoor") {
		        echo '<p>Il est dit, dans les récits les plus anciens, qu’Umbra, cette entité mystérieuse aux contours
		            humains, hante les lieux où règnent désespoir et souffrance. On la dépeint comme un spectre éthéré,
		            flottant dans les ténèbres, attirée par ceux qui s’accrochent à un dernier espoir. Les légendes
		            murmurent qu’elle détient un pouvoir rare et redoutable : la capacité de guérir des maux incurables.
		            Cependant, cette bénédiction est entachée d’une terrible incertitude : les chances que son
		            intervention soit salvatrice sont infimes, et les conséquences d’un échec bien plus terrifiantes que
		            la maladie elle-même.<br><br></p>

		        <p>Nombreux sont les récits tragiques qui ornent les pages des vieux grimoires. On y raconte l’histoire
		            de ce père éperdu qui, dans un ultime acte de désespoir, invoqua Umbra pour sauver son fils atteint
		            d’un mal inexorable. Lorsque l’entité apparut, la pièce s’emplit d’un froid mortel, et le spectre
		            murmura une incantation incompréhensible. Le garçon se redressa soudainement, libéré de ses
		            tourments. Mais au même instant, le père s’effondra, son souffle coupé, comme si Umbra avait réclamé
		            une vie pour en sauver une autre. Certains prétendent que ce genre d’échange est le véritable prix à
		            payer ; d’autres affirment qu’il ne s’agit que du caprice aléatoire de l’entité.<br></p>

		        <p>Ces témoignages, bien qu’éparpillés dans le temps, partagent un même avertissement : appeler Umbra,
		            c’est jouer à un jeu dont les règles échappent à la raison. Une lueur d’espoir peut se transformer
		            en une obscurité plus profonde encore. Ainsi, ceux qui osent invoquer cette ombre salvatrice ne le
		            font jamais sans une peur viscérale : sauver une vie, oui, mais à quel prix ?<br></p>
		        <p><strong>ENI{UmBr4_l4_SalvATr1c3}</strong></p>';
                } else {
		        echo '<p>Vous vous êtes perdu cher ami ?</p>
		        <p>Seul les membres de la famille Dreadmoor sont autorisés à consulter ce document</p>';
		} ?>
            </div>
        </div>
    </main>

    <footer>
        <p>Blakeroft &copy; 2025</p>
    </footer>

</body>

</html>
