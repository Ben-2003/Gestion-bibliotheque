<?php
require_once("../config/db.php");
include("../templates/header.php");
require_once "../config/auth.php";


$etudiants = $pdo->query("SELECT * FROM Etudiant")->fetchAll();
$livres = $pdo->query("SELECT * FROM Livre")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $etudiant = $_POST['etudiant'];
    $livre = $_POST['livre'];
    $date = date("Y-m-d");

    // Vérifier si le livre est déjà emprunté
    $check = $pdo->prepare("SELECT COUNT(*) FROM Emprunter WHERE CodeLivre=?");
    $check->execute([$livre]);

    if ($check->fetchColumn() > 0) {
        $erreur = "❌ Ce livre est déjà emprunté";
    } else {
        $sql = "INSERT INTO Emprunter VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$etudiant, $livre, $date]);

        header("Location: index.php");
    }
}
?>

<h2>➕ Nouvel emprunt</h2>

<?php if (!empty($erreur)): ?>
<div class="alert alert-danger"><?= $erreur ?></div>
<?php endif; ?>

<form method="post">
    <select name="etudiant" class="form-control mb-2" required>
        <option value="">-- Étudiant --</option>
        <?php foreach ($etudiants as $e): ?>
            <option value="<?= $e['CodeEtudiant'] ?>">
                <?= $e['Nom'] . " " . $e['Prenom'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="livre" class="form-control mb-2" required>
        <option value="">-- Livre --</option>
        <?php foreach ($livres as $l): ?>
            <option value="<?= $l['CodeLivre'] ?>">
                <?= $l['Titre'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button class="btn btn-success">Enregistrer</button>
</form>

<?php include("../templates/footer.php"); ?>
