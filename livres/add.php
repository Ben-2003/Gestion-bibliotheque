<?php
require_once("../config/db.php");
include("../templates/header.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Données du formulaire
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $date = $_POST['date'];

    // Insertion sécurisée
    $sql = "INSERT INTO Livre (Titre, Auteur, DateEdition)
            VALUES (?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titre, $auteur, $date]);

    header("Location: index.php");
}
?>

<h2>➕ Ajouter un livre</h2>

<form method="post">
    <input type="text" name="titre" class="form-control mb-2" placeholder="Titre" required>
    <input type="text" name="auteur" class="form-control mb-2" placeholder="Auteur" required>
    <input type="date" name="date" class="form-control mb-2">
    <button class="btn btn-success">Enregistrer</button>
</form>

<?php include("../templates/footer.php"); ?>
