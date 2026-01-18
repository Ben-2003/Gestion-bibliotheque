<?php
// PROTECTION + SESSION (TOUJOURS EN PREMIER)
require_once "../config/auth.php";
require_once "../config/db.php";
include("../templates/header.php");

// Sécurité : si username n'est pas défini
$username = $_SESSION["username"] ?? "Utilisateur";

// Récupération des livres
$livres = $pdo->query("SELECT * FROM Livre")->fetchAll();
?>

<div class="container mt-4">

   

    <!-- Carte principale -->
    <div class="card shadow-lg border-0 rounded-4">

        <!-- En-tête -->
        <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📘 Gestion des livres</h4>
            <a href="add.php" class="btn btn-light fw-bold">
                ➕ Ajouter un livre
            </a>
        </div>

        <!-- Contenu -->
        <div class="card-body">

            <!-- Tableau -->
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center">

                    <thead class="table-dark">
                        <tr>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Date d'édition</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($livres as $l): ?>
                        <tr>
                            <td class="fw-semibold"><?= htmlspecialchars($l['Titre']) ?></td>
                            <td><?= htmlspecialchars($l['Auteur']) ?></td>
                            <td><?= htmlspecialchars($l['DateEdition']) ?></td>
                            <td>
                                <a href="modifier.php?id=<?= $l['CodeLivre'] ?>"
                                   class="btn btn-warning btn-sm me-1">✏️</a>

                                <a href="delete.php?id=<?= $l['CodeLivre'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Supprimer ce livre ?')">🗑️</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>

            <!-- Aucun livre -->
            <?php if (count($livres) === 0): ?>
                <div class="alert alert-info text-center mt-3">
                    Aucun livre enregistré pour le moment 📭
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php include("../templates/footer.php"); ?>
