<?php
// Démarrage de la session pour gérer l'authentification
session_start();

// Inclusion du fichier de connexion à la base de données
require_once "../config/db.php";

// Variable pour stocker les messages d'erreur
$error = "";

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Récupération et nettoyage du nom d'utilisateur
    $username = trim($_POST["username"]);

    // Récupération du mot de passe
    $password = $_POST["password"];

    // Préparation de la requête pour récupérer l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE nomutilisateur = ?");
    $stmt->execute([$username]);

    // Récupération des données utilisateur
    $user = $stmt->fetch();

    // Vérification de l'existence de l'utilisateur et du mot de passe
    if ($user && password_verify($password, $user["motdepasse"])) {

        // Stockage des informations utilisateur dans la session
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["nomutilisateur"];
        $_SESSION["role"] = $user["role"];
        $_SESSION["CodeEtudiant"] = $user["CodeEtudiant"];

        // Redirection selon le rôle de l'utilisateur
        if ($user["role"] === "admin") {
            header("Location: ../dashbord/admin.php");
        } else {
            header("Location: ../dashbord/user.php");
        }
        exit;
    } else {
        // Message d'erreur si les identifiants sont incorrects
        $error = "Nom d'utilisateur ou mot de passe incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <!-- Titre de la page -->
    <title>Connexion Bibliothèque</title>

    <!-- Inclusion de Bootstrap -->
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">

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

        /* Carte de connexion */
        .card-connexion {
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
        .card-connexion h3 {
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
            background: linear-gradient(90deg, #6c63ff, #4facfe);
            border: none;
            transition: 0.3s;
        }

        /* Effet au survol du bouton */
        .btn-primary:hover {
            transform: scale(1.05);
        }

        /* Animation d'apparition */
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

    <!-- Carte de connexion -->
    <div class="card-connexion">
        <h3 class="text-center mb-4">Connexion</h3>

        <!-- Affichage du message d'erreur s'il existe -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire de connexion -->
        <form method="POST">

            <!-- Champ nom d'utilisateur -->
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" class="form-control"
                       placeholder="Votre nom d'utilisateur" required>
            </div>

            <!-- Champ mot de passe -->
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control"
                       placeholder="Votre mot de passe" required>
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" class="btn btn-primary">Se connecter</button>

            <!-- Lien vers la page d'inscription -->
            <p class="text-center mt-3">
                Pas encore de compte ? <a href="../auth/register.php">Inscrivez-vous</a>
            </p>
        </form>
    </div>

</body>
</html>
