<?php
session_start();
require_once("../config/db.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../auth/login.php");
    exit;
}

$stmt = $pdo->prepare(
    "SELECT Livre.Titre, Livre.Auteur, Emprunter.DateEmprunt
     FROM Emprunter
     JOIN Livre ON Livre.CodeLivre = Emprunter.CodeLivre
     WHERE Emprunter.CodeEtudiant = ?"
);
$stmt->execute([$_SESSION['CodeEtudiant']]);
$emprunts = $stmt->fetchAll();
?>

<h2>📖 Mes emprunts</h2>

<?php if (count($emprunts) === 0): ?>
    <div class="alert alert-info">Aucun emprunt pour le moment.</div>
<?php else: ?>
<table class="table table-bordered">
<tr>
    <th>Titre</th>
    <th>Auteur</th>
    <th>Date d'emprunt</th>
</tr>

<?php foreach ($emprunts as $e): ?>
<tr>
    <td><?= htmlspecialchars($e['Titre']) ?></td>
    <td><?= htmlspecialchars($e['Auteur']) ?></td>
    <td><?= $e['DateEmprunt'] ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
