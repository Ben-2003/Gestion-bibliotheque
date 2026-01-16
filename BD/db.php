<?php
// Informations de connexion à MySQL
$host = "localhost";     // Serveur
$dbname = "biblio";      // Nom de la base
$user = "root";          // Utilisateur MySQL
$password = "";          // Mot de passe (souvent vide en local)

try {
    // Création de la connexion PDO
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $password
    );

    // Activer les erreurs SQL (très utile pour apprendre)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // En cas d'erreur, on arrête tout et on affiche le message
    die("Erreur de connexion : " . $e->getMessage());
}
