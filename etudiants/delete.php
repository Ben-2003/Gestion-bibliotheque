<?php
require_once("../config/db.php");
require_once "../config/auth.php";


$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM Etudiant WHERE CodeEtudiant = ?");
$stmt->execute([$id]);

header("Location: index.php");
