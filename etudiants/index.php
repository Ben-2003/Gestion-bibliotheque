<?php
require_once("../config/db.php");
include("../templates/header.php");

$etudiants = $pdo->query("SELECT * FROM Etudiant")->fetchAll();
?>

<h2>👨‍🎓 Gestion des étudiants</h2>

<a href="add.php" class="btn btn-primary mb-3">➕ Ajouter</a>
<link href="assets/style.css" rel="stylesheet">


<table class="table table-bordered table-hover">
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Adresse</th>
        <th>Classe</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($etudiants as $e): ?>
    <tr>
        <td><?= htmlspecialchars($e['Nom']) ?></td>
        <td><?= htmlspecialchars($e['Prenom']) ?></td>
        <td><?= htmlspecialchars($e['Adresse']) ?></td>
        <td><?= htmlspecialchars($e['Classe']) ?></td>
        <td>
            <a href="modifier.php?id=<?= $e['CodeEtudiant'] ?>" class="btn btn-warning btn-sm">✏ Modifier</a>
            <a href="delete.php?id=<?= $e['CodeEtudiant'] ?>" 
               class="btn btn-danger btn-sm"
               onclick="return confirm('Supprimer cet étudiant ?')">
               🗑 Supprimer
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include("../templates/footer.php"); ?>
