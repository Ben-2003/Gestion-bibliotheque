<?php
require_once("../config/db.php");

$e = $_GET['e'];
$l = $_GET['l'];

$stmt = $pdo->prepare("DELETE FROM Emprunter WHERE CodeEtudiant=? AND CodeLivre=?");
$stmt->execute([$e, $l]);

header("Location: index.php");
