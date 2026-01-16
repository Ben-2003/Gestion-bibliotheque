<?php
require_once("../config/db.php");
include("../templates/header.php");

$id = $_GET['id'];

// Récupération du livre
$stmt = $pdo->prepare("SELECT * FROM Livre WHERE CodeLivre = ?");
$stmt->execute([$id]);
$livre = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $sql = "UPDATE Livre 
            SET Titre=?, Auteur=?, DateEdition=?
            WHERE CodeLivre=?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['titre'],
        $_POST['auteur'],
        $_POST['date'],
        $id
    ]);

    header("Location: index.php");
}
?>

<h2>✏ Modifier un livre</h2>

<form method="post">
    <input type="text" name="titre" value="<?= $livre['Titre'] ?>" class="form-control mb-2">
    <input type="text" name="auteur" value="<?= $livre['Auteur'] ?>" class="form-control mb-2">
    <input type="date" name="date" value="<?= $livre['DateEdition'] ?>" class="form-control mb-2">
    <button class="btn btn-warning">Modifier</button>
</form>

<?php include("../templates/footer.php"); ?>
