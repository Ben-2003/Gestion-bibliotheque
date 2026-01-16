<?php
require_once("../config/db.php");
include("../templates/header.php");

$id = $_GET['id'];

// Récupérer l'étudiant
$stmt = $pdo->prepare("SELECT * FROM Etudiant WHERE CodeEtudiant = ?");
$stmt->execute([$id]);
$etudiant = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "UPDATE Etudiant 
            SET Nom=?, Prenom=?, Adresse=?, Classe=?
            WHERE CodeEtudiant=?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['adresse'],
        $_POST['classe'],
        $id
    ]);

    header("Location: index.php");
}
?>

<h2>✏ Modifier étudiant</h2>

<form method="post">
    <input type="text" name="nom" value="<?= $etudiant['Nom'] ?>" class="form-control mb-2">
    <input type="text" name="prenom" value="<?= $etudiant['Prenom'] ?>" class="form-control mb-2">
    <input type="text" name="adresse" value="<?= $etudiant['Adresse'] ?>" class="form-control mb-2">
    <input type="text" name="classe" value="<?= $etudiant['Classe'] ?>" class="form-control mb-2">
    <button class="btn btn-warning">Modifier</button>
</form>

<?php include("../templates/footer.php"); ?>
