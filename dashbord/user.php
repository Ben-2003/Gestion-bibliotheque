<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once("../templates/header.php");


if ($_SESSION["role"] !== "user") {
    header("Location: ../index.php");
    exit;
}

$stmt = $pdo->prepare(
    "SELECT Livre.Titre, Emprunter.DateEmprunt
     FROM Emprunter
     JOIN Livre ON Livre.CodeLivre = Emprunter.CodeLivre
     WHERE Emprunter.CodeEtudiant = ?"
);
$stmt->execute([$_SESSION["CodeEtudiant"]]);
$emprunts = $stmt->fetchAll();
?>



<h2>👤 Dashboard Utilisateur</h2>
<a href="../user/livres.php" class="btn btn-primary w-100 mb-2">
    📚 Voir les livres
</a>

<a href="../user/mes_emprunts.php" class="btn btn-secondary w-100">
    📖 Mes emprunts
</a>

<h4>📚 Mes emprunts</h4>

<table class="table table-bordered">
<tr>
    <th>Livre</th>
    <th>Date d'emprunt</th>
</tr>

<?php foreach ($emprunts as $e): ?>
<tr>
    <td><?= $e['Titre'] ?></td>
    <td><?= $e['DateEmprunt'] ?></td>
</tr>
<?php endforeach; ?>
</table>

<?php require_once("../templates/footer.php"); ?>
