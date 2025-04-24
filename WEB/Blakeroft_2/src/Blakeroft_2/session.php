<?php
require_once "vendor/autoload.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$privateKey = file_get_contents("private.pem");
$publicKey = file_get_contents("public.pem");

$cookieName = "auth_token";
$jwt = $_COOKIE[$cookieName] ?? null;

$payload = [
    "firstname" => "Unknown",
    "lastname" => "Unknown",
    "age" => "Unknown",
    "iat" => time(),
    "exp" => time() + 14400,
];

$sessionValid = false;
$userName = "";

if (!$jwt) {
    $jwt = JWT::encode($payload, $privateKey, "RS256");
    setcookie($cookieName, $jwt, time() + 3600, "/", "", false, true);
} else {
    try {
        $decoded = JWT::decode($jwt, new Key($publicKey, "RS256"));
        $sessionValid = true;
        $Firstname = $decoded->firstname;
        $Lastname = $decoded->lastname;
        $Age = $decoded->age;
    } catch (Exception $eRS256) {
        try {
            $decoded = JWT::decode($jwt, new Key($publicKey, "HS256"));
            $sessionValid = true;
            $Firstname = $decoded->firstname;
            $Lastname = $decoded->lastname;
            $Age = $decoded->age;
        } catch (Exception $eHS256) {
            echo "<script>alert('Session non valide : {$eHS256->getMessage()}');</script>";
        }
    }
}
?>
