<?php
require_once("../config/db.php");
include("../Templates/header.php");

// Jointure pour afficher des infos lisibles
$sql = "
SELECT 
    em.CodeEtudiant,
    em.CodeLivre,
    e.Nom, e.Prenom,
    l.Titre,
    em.DateEmprunt
FROM Emprunter em
JOIN Etudiant e ON em.CodeEtudiant = e.CodeEtudiant
JOIN Livre l ON em.CodeLivre = l.CodeLivre
";

$emprunts = $pdo->query($sql)->fetchAll();
?>

<h2>🔁 Emprunts</h2>

<a href="add.php" class="btn btn-primary mb-3">➕ Nouvel emprunt</a>

<table class="table table-bordered">
    <tr>
        <th>Étudiant</th>
        <th>Livre</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

    <?php foreach ($emprunts as $em): ?>
    <tr>
        <td><?= $em['Nom'] . " " . $em['Prenom'] ?></td>
        <td><?= $em['Titre'] ?></td>
        <td><?= $em['DateEmprunt'] ?></td>
        <td>
            <a href="supprimer.php?e=<?= $em['CodeEtudiant'] ?>&l=<?= $em['CodeLivre'] ?>"
               class="btn btn-danger btn-sm"
               onclick="return confirm('Supprimer cet emprunt ?')">
               🗑
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include("../templates/footer.php"); ?>
