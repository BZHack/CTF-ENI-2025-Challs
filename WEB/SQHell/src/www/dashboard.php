<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php"); // Redirige vers login si non connecté
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Bienvenue, <?= $_SESSION['user'] ?> !</h2>
        <p>Vous êtes connecté avec succès.</p>
        <p>Flag : <b>ENI{SQL_1nj€ct10n_b@s1c}</b></p>
        <a href="logout.php" class="logout-btn">Déconnexion</a>
    </div>
</body>
</html>
