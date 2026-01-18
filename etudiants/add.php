<?php
require_once("../config/db.php");
include("../templates/header.php");
require_once "../config/auth.php";
require_once "../config/admin.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupération sécurisée des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $classe = $_POST['classe'];

    // Requête préparée (sécurité)
    $sql = "INSERT INTO Etudiant (Nom, Prenom, Adresse, Classe)
            VALUES (?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $adresse, $classe]);

    // Redirection après insertion
    header("Location: index.php");
}
?>

<h2>➕ Ajouter un étudiant</h2>

<form method="post">
    <input type="text" name="nom" class="form-control mb-2" placeholder="Nom" required>
    <input type="text" name="prenom" class="form-control mb-2" placeholder="Prénom" required>
    <input type="text" name="adresse" class="form-control mb-2" placeholder="Adresse">
    <input type="text" name="classe" class="form-control mb-2" placeholder="Classe">
    <button class="btn btn-success">Enregistrer</button>
</form>

<?php include("../templates/footer.php"); ?>
