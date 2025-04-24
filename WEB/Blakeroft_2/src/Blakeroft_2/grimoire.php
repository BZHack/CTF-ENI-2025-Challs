<?php
    require_once 'session.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blakeroft</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>

<body>
    <header>
        <h1>Blakeroft</h1>
        <nav>
            <ul>
                <li><a href="/">Accueil</a></li>
                <li><a href="#">Grimoire</a></li>
                <li><a href="Umbra.php">Umbra</a></li>
                <?php if (!empty($Firstname) && ($Firstname != "Unknown" || $Lastname != "Unknown")) {
                    echo '<li><span class="green-box">Bonjour ' . htmlspecialchars($Firstname) . '</span></li>'; 
                } else { 
                    echo '<li><span class="red-box">Non authentifié</span></li>';
                } ?>
            </ul>
        </nav>
    </header>
    <main class="main-background">
     <div class="button-container">
        <button class="grimoire-button" onclick="window.location.href='/Umbra.php'" >En savoir plus sur Umbra</button>
    </div>
        <div class="image-container">
            <img src="assets/Rituel-Invocation-Umbra.png" alt="Image représentant le grimoire">
        </div>
    </main>

    <footer>
        <p>Blakeroft &copy; 2025</p>
    </footer>
</body>

</html>

