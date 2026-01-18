<?php
require_once("../config/db.php");
require_once "../config/auth.php";


$id = $_GET['id'];

// Suppression
$stmt = $pdo->prepare("DELETE FROM Livre WHERE CodeLivre = ?");
$stmt->execute([$id]);

header("Location: index.php");
