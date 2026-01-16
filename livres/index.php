<?php
require_once("../config/db.php");
include("../templates/header.php");

// Récupération de tous les livres
$livres = $pdo->query("SELECT * FROM Livre")->fetchAll();
?>

<h2>📘 Gestion des livres</h2>

<a href="add.php" class="btn btn-primary mb-3">➕ Ajouter un livre</a>

<table class="table table-bordered table-hover">
    <tr>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Date d'édition</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($livres as $l): ?>
    <tr>
        <td><?= htmlspecialchars($l['Titre']) ?></td>
        <td><?= htmlspecialchars($l['Auteur']) ?></td>
        <td><?= $l['DateEdition'] ?></td>
        <td>
            <a href="modifier.php?id=<?= $l['CodeLivre'] ?>" class="btn btn-warning btn-sm">✏</a>
            <a href="delete.php?id=<?= $l['CodeLivre'] ?>"
               class="btn btn-danger btn-sm"
               onclick="return confirm('Supprimer ce livre ?')">🗑</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include("../templates/footer.php"); ?>
