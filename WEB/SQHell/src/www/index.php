<?php
session_start(); // Démarrer la session

// Configuration de la base de données
$host = 'db';
$dbname = 'injection_sql_basic';
$username = 'user_ctf_eni';
$password = 's5719?Bp;k';

$error = "";

// Connexion à la base de données
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Vérification du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Requête pour vérifier l'utilisateur
    $stmt = $pdo->query("SELECT * FROM Users WHERE user = '$user' AND password = '$pass'");
    $userData = $stmt->fetch();

    if ($userData) {
        $_SESSION['user'] = $userData['user']; // Stocker l'utilisateur en session
        header("Location: dashboard.php"); // Redirection après connexion
        exit;
    } else {        
        $error = "Échec de la connexion. Vérifiez vos identifiants.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Connexion</h2>
        <form method="POST">
            <label>Nom d'utilisateur :</label>
            <input type="text" name="username" required>

            <label>Mot de passe :</label>
            <input type="password" name="password" required>

            <button type="submit">Se connecter</button>
        </form>
      <?php if (!empty($error)) { echo "<div><p class='error'>$error</p></div>"; } ?>
    </div>
</body>
</html>
