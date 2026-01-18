<?php
require_once "../config/auth.php"; // protection
require_once "../config/db.php";
include("../templates/header.php");

// Récupération des emprunts en cours
$sql = "
SELECT 
    em.CodeEtudiant,
    em.CodeLivre,
    e.Nom,
    e.Prenom,
    l.Titre,
    em.DateEmprunt
FROM Emprunter em
JOIN Etudiant e ON em.CodeEtudiant = e.CodeEtudiant
JOIN Livre l ON em.CodeLivre = l.CodeLivre
ORDER BY em.DateEmprunt DESC
";

$emprunts = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">

    <div class="card shadow-lg border-0 rounded-4">

        <!-- En-tête -->
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center rounded-top-4">
            <h4 class="mb-0">📚 Livres en cours d’emprunt</h4>
            <a href="add.php" class="btn btn-light fw-bold">
                ➕ Nouvel emprunt
            </a>
        </div>

        <!-- Contenu -->
        <div class="card-body">

            <?php if (count($emprunts) > 0): ?>

            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center">

                    <thead class="table-dark">
                        <tr>
                            <th>Étudiant</th>
                            <th>Livre</th>
                            <th>Date d’emprunt</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($emprunts as $em): ?>
                        <tr>
                            <td class="fw-semibold">
                                <?= htmlspecialchars($em["Nom"] . " " . $em["Prenom"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($em["Titre"]) ?>
                            </td>

                            <td>
                                <?= date("d/m/Y", strtotime($em["DateEmprunt"])) ?>
                            </td>

                            <td>
                                <a href="delete.php?e=<?= $em['CodeEtudiant'] ?>&l=<?= $em['CodeLivre'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Confirmer le retour du livre ?')">
                                    🔄 Retourner
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>

            <?php else: ?>
                <div class="alert alert-info text-center">
                    Aucun livre n’est actuellement emprunté 📭
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php include("../templates/footer.php"); ?>
