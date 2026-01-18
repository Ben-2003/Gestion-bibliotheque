<?php
// Démarrage de la session pour gérer les données utilisateur
session_start();

// Inclusion du fichier de connexion à la base de données
require_once "../config/db.php";

// Variable pour stocker les messages d'erreur
$error = "";

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Récupération et nettoyage des données envoyées par le formulaire
    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $classe = trim($_POST["classe"]);
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // Vérification que tous les champs sont remplis
    if (!$nom || !$prenom || !$classe || !$username || !$password) {
        $error = "Tous les champs sont obligatoires";
    } else {

        // Insertion de l'étudiant dans la table Etudiant
        $stmt = $pdo->prepare(
            "INSERT INTO Etudiant (Nom, Prenom, Classe) VALUES (?, ?, ?)"
        );
        $stmt->execute([$nom, $prenom, $classe]);

        // Récupération de l'identifiant de l'étudiant nouvellement créé
        $codeEtudiant = $pdo->lastInsertId();

        // Insertion de l'utilisateur lié à l'étudiant
        $stmt = $pdo->prepare(
            "INSERT INTO utilisateur (nomutilisateur, motdepasse, role, CodeEtudiant)
             VALUES (?, ?, 'user', ?)"
        );
        $stmt->execute([
            $username,
            password_hash($password, PASSWORD_DEFAULT), // Hash sécurisé du mot de passe
            $codeEtudiant
        ]);

        // Redirection vers la page de connexion après inscription
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <!-- Titre de la page -->
    <title>Inscription Bibliothèque</title>

    <!-- Inclusion de Bootstrap -->
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* Style général de la page */
        body {
            background: linear-gradient(135deg, #74ebd5 0%, #9face6 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Carte d'inscription */
        .card-inscription {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            animation: fadeIn 1s ease-in-out;
        }

        /* Titre de la carte */
        .card-inscription h3 {
            font-weight: bold;
            color: #333;
        }

        /* Groupe de champs */
        .form-group {
            margin-bottom: 25px;
        }

        /* Champs de formulaire */
        .form-control {
            border-radius: 12px;
            padding: 14px;
            font-size: 16px;
            border: 1px solid #ddd;
            width: 100%;
            transition: all 0.3s ease;
        }

        /* Effet focus sur les champs */
        .form-control:focus {
            border-color: #6c63ff;
            box-shadow: 0 0 8px rgba(108,99,255,0.5);
        }

        /* Bouton principal */
        .btn-primary {
            border-radius: 12px;
            padding: 14px;
            font-weight: bold;
            width: 100%;
            transition: 0.3s;
            background: linear-gradient(90deg, #6c63ff, #4facfe);
            border: none;
        }

        /* Effet au survol du bouton */
        .btn-primary:hover {
            transform: scale(1.05);
            background: linear-gradient(90deg, #4facfe, #6c63ff);
        }

        /* Animation d'apparition */
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

<!-- Carte d'inscription -->
<div class="card-inscription" action="login.php">
    <h3 class="text-center mb-4">📚 Inscription à la Bibliothèque</h3>

    <!-- Affichage du message d'erreur s'il existe -->
    <?php if (!empty($error)): ?>
    <div class="alert alert-danger text-center">
        <?= $error ?>
    </div>
    <?php endif; ?>

    <!-- Formulaire d'inscription -->
    <form method="POST" action="">

        <!-- Champ nom d'utilisateur -->
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text"
                   name="username"
                   id="username"
                   class="form-control"
                   placeholder="Choisissez un nom d'utilisateur"
                   required>
        </div>

        <!-- Champ mot de passe -->
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password"
                   name="password"
                   id="password"
                   class="form-control"
                   placeholder="Mot de passe sécurisé"
                   required>
        </div>

        <!-- Champ nom -->
        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <!-- Champ prénom -->
        <div class="form-group">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>

        <!-- Champ classe -->
        <div class="form-group">
            <label>Classe</label>
            <input type="text" name="classe" class="form-control" required>
        </div>

        <hr>

        <!-- Bouton de validation -->
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">
                ✅ Valider l'inscription
            </button>
        </div>

    </form>
</div>

</body>
</html>
