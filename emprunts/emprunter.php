<?php
include("../config/db.php");

// Récupérer tous les étudiants
$etudiants = $pdo->query("SELECT * FROM Etudiant")->fetchAll();
?>

<?php
// Récupérer les livres qui ne sont pas empruntés
$livres = $pdo->query("
    SELECT * FROM Livre
    WHERE CodeLivre NOT IN (
        SELECT CodeLivre FROM Emprunter
    )
")->fetchAll();
?>

<?php
// Si on clique sur le bouton Retourner
if (isset($_POST['retourner'])) {

    $codeEtudiant = $_POST['codeEtudiant'];
    $codeLivre = $_POST['codeLivre'];

    // Supprimer l'emprunt
    $stmt = $pdo->prepare("
        DELETE FROM Emprunter
        WHERE CodeEtudiant = ? AND CodeLivre = ?
    ");

    $stmt->execute([$codeEtudiant, $codeLivre]);

    // Recharger la page
    header("Location: index.php");
    exit;
}
?>


<?php
$emprunts = $pdo->query("
    SELECT 
        Etudiant.CodeEtudiant,
        Livre.CodeLivre,
        Etudiant.Nom AS etudiant,
        Livre.Titre AS livre,
        Emprunter.DateEmprunt
    FROM Emprunter
    JOIN Etudiant ON Etudiant.CodeEtudiant = Emprunter.CodeEtudiant
    JOIN Livre ON Livre.CodeLivre = Emprunter.CodeLivre
")->fetchAll();
?>





<?php
include("../config/db.php");

// Si on a cliqué sur le bouton Emprunter
if (isset($_POST['emprunter'])) {

    // Récupérer les valeurs du formulaire
    $codeEtudiant = $_POST['etudiant'];
    $codeLivre = $_POST['livre'];

    // Date du jour
    $date = date("Y-m-d");

    // Insérer l'emprunt dans la table Emprunter
    $stmt = $pdo->prepare("
        INSERT INTO Emprunter (CodeEtudiant, CodeLivre, DateEmprunt)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([$codeEtudiant, $codeLivre, $date]);

    // Recharger la page pour voir les changements
    header("Location: index.php");
    exit;
}

// Récupérer étudiants et livres (comme avant)
$etudiants = $pdo->query("SELECT * FROM Etudiant")->fetchAll();

$livres = $pdo->query("
    SELECT * FROM Livre
    WHERE CodeLivre NOT IN (
        SELECT CodeLivre FROM Emprunter
    )
")->fetchAll();
?>




<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gestion des emprunts</title>
</head>
<body class="bg-light">

<div class="container mt-5">

    <h1 class="text-center mb-4">📚 Gestion des emprunts</h1>

    <!-- FORMULAIRE -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Nouvel emprunt
        </div>
        <div class="card-body">


        <form method="POST" class="row g-3">

<div class="col-md-6">
    <label class="form-label">Étudiant</label>
    <select name="etudiant" class="form-select" required>
        <option value="">-- Choisir un étudiant --</option>
        <?php foreach ($etudiants as $e): ?>
            <option value="<?php echo $e['CodeEtudiant']; ?>">
                <?php echo $e['Nom']; ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="col-md-6">
    <label class="form-label">Livre</label>
    <select name="livre" class="form-select" required>
        <option value="">-- Choisir un livre --</option>
        <?php foreach ($livres as $l): ?>
            <option value="<?php echo $l['CodeLivre']; ?>">
                <?php echo $l['Titre']; ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="col-12">
    <button type="submit" name="emprunter" class="btn btn-success mt-3">
        Emprunter
    </button>
</div>
</form>
</div>
    </div>


<h2>Emprunts en cours</h2>

<div class="card">
    <div class="card-header bg-dark text-white">
        Emprunts en cours
    </div>

    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>Étudiant</th>
                    <th>Livre</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            <?php foreach ($emprunts as $emp): ?>
                <tr>
                    <td><?php echo $emp['etudiant']; ?></td>
                    <td><?php echo $emp['livre']; ?></td>
                    <td><?php echo $emp['DateEmprunt']; ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="codeEtudiant" value="<?php echo $emp['CodeEtudiant']; ?>">
                            <input type="hidden" name="codeLivre" value="<?php echo $emp['CodeLivre']; ?>">
                            <button type="submit" name="retourner" class="btn btn-danger btn-sm">
                                Retourner
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

</div> <!-- fin container -->
</body>
</html>



</body>
</html>

