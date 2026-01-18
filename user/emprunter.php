<?php
session_start();
require_once("../db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit;
}

$codeLivre = $_GET['id'];
$codeEtudiant = $_SESSION['CodeEtudiant'];

// Vérifier disponibilité
$stmt = $pdo->prepare(
    "SELECT Disponible FROM Livre WHERE CodeLivre=?"
);
$stmt->execute([$codeLivre]);
$livre = $stmt->fetch();

if ($livre && $livre['Disponible']) {

    // Enregistrer emprunt
    $pdo->prepare(
        "INSERT INTO Emprunter (CodeEtudiant, CodeLivre, DateEmprunt)
         VALUES (?, ?, CURDATE())"
    )->execute([$codeEtudiant, $codeLivre]);

    // Rendre le livre indisponible
    $pdo->prepare(
        "UPDATE Livre SET Disponible=FALSE WHERE CodeLivre=?"
    )->execute([$codeLivre]);
}

header("Location: livres.php");
exit;
