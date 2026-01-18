<?php
// Inclusion du fichier d'authentification (vérifie si l'utilisateur est connecté)
require_once "config/auth.php";

// Récupération des informations utilisateur depuis la session
$username = $_SESSION["username"];
$role = $_SESSION["role"];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <!-- Titre de la page -->
    <title>Bibliothèque Universitaire</title>

    <!-- Inclusion de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Barre latérale (menu) */
        .sidebar {
            height: 100vh;
            background-color: #f0f8ff;
            padding-top: 20px;
            position: fixed;
            width: 220px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        /* Liens du menu */
        .sidebar a {
            display: block;
            padding: 12px;
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }

        /* Effet au survol des liens */
        .sidebar a:hover {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }

        /* Zone de contenu principal */
        .content {
            margin-left: 240px;
            padding: 20px;
        }
    </style>
</head>

<body>

<!-- Barre de navigation supérieure -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">

        <!-- Nom de l'application -->
        <span class="navbar-brand">📚 Bibliothèque</span>

        <!-- Affichage du nom et du rôle de l'utilisateur connecté -->
        <span class="text-white">
            👋 <?= htmlspecialchars($username) ?> (<?= $role ?>)
        </span>

        <!-- Lien de déconnexion -->
        <a href="auth/logout.php" class="btn btn-light btn-sm ms-3">Déconnexion</a>
    </div>
</nav>

<!-- Barre latérale (menu) -->
<div class="sidebar">
    <h6 class="text-center fw-bold">Menu</h6>

    <!-- Lien vers l'accueil -->
    <a href="index.php">🏠 Accueil</a>

    <!-- Menu spécifique selon le rôle -->
    <?php if ($role === "admin"): ?>

        <!-- Liens visibles uniquement pour l'administrateur -->
        <a href="etudiants/index.php">👨‍🎓 Étudiants</a>
        <a href="livres/index.php">📘 Livres</a>
        <a href="emprunts/index.php">🔁 Emprunts</a>

    <?php else: ?>

        <!-- Liens visibles pour l'utilisateur simple -->
        <a href="user/livres.php">📚 Livres</a>
        <a href="user/mes_emprunts.php">📖 Mes emprunts</a>

    <?php endif; ?>
</div>

<!-- Contenu principal -->
<div class="content">

    <!-- Contenu affiché pour l'administrateur -->
    <?php if ($role === "admin"): ?>
        <h2>👑 Dashboard Administrateur</h2>
        <p class="text-muted">Gestion complète de la bibliothèque</p>

        <div class="row mt-4">

            <!-- Carte gestion des étudiants -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5>Étudiants</h5>
                        <a href="etudiants/index.php" class="btn btn-primary">Gérer</a>
                    </div>
                </div>
            </div>

            <!-- Carte gestion des livres -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5>Livres</h5>
                        <a href="livres/index.php" class="btn btn-success">Gérer</a>
                    </div>
                </div>
            </div>

            <!-- Carte gestion des emprunts -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h5>Emprunts</h5>
                        <a href="emprunts/index.php" class="btn btn-warning">Gérer</a>
                    </div>
                </div>
            </div>

        </div>

    <?php else: ?>

        <!-- Contenu affiché pour l'utilisateur -->
        <h2>👋 Bienvenue <?= htmlspecialchars($username) ?></h2>
        <p class="text-muted">Espace utilisateur</p>

        <!-- Carte Mes emprunts -->
        <div class="card shadow mt-4">
            <div class="card-body text-center">
                <h5>📖 Mes emprunts</h5>
                <a href="user/mes_emprunts.php" class="btn btn-primary">Voir</a>
            </div>
        </div>  

        <!-- Carte Livres disponibles -->
        <div class="card shadow mt-4">
            <div class="card-body text-center">
                <h5>📖 livres</h5>
                <a href="user/livres.php" class="btn btn-primary">Voir</a>
            </div>
        </div>

    <?php endif; ?>

</div>

</body>
</html>
