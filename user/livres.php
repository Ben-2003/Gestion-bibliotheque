<?php
require_once "../config/auth.php";
require_once "../config/db.php";
require_once "../templates/header.php";


if ($_SESSION["role"] !== "user") {
    header("Location: ../index.php");
    exit;
}

$livres = $pdo->query("SELECT * FROM Livre WHERE Disponible = 1")->fetchAll();
?>


<h3>📚 Livres disponibles</h3>

<table class="table table-striped">
<tr>
    <th>Titre</th>
    <th>Auteur</th>
    <th>Action</th>
</tr>

<?php foreach ($livres as $l): ?>
<tr>
    <td><?= $l['Titre'] ?></td>
    <td><?= $l['Auteur'] ?></td>
    <td>
    <a href="../emprunts/index.php?id=<?= $l['CodeLivre'] ?>"
           class="btn btn-primary btn-sm">
           Emprunter
        </a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<?php require_once("../templates/footer.php"); ?>
