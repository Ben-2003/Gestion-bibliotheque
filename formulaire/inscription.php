<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription Bibliothèque</title>

    <!-- Bootstrap CSS -->
     <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="bootstrap/style2.css">
</head>
<body>

<div class="container mt-5 border ">
    <div class="row justify-content-center  ">
        <div class="col-md-6 ">

            <h3 class="text-center mb-4">Inscription à la Bibliothèque</h3>

            <form">
                <!-- Champ 1 : Nom -->
                <div class="mb-3">
                    <label class="form-label" for="nom">Nom complet</label>
                    <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez votre nom" required>
                </div>

                 <div class="mb-3">
                    <label class="form-label" for="prenom">prenom</label>
                    <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Entrez votre prenom" required>
                </div>

                <!-- Champ 2 : Matricule -->
                <div class="mb-3">
                    <label class="form-label" for="code">code etudiant</label>
                    <input type="text" name="code" id="code" class="form-control" placeholder="Ex : ETU2024" required>
                </div>

                <!-- Champ 3 : Email -->
                <div class="mb-3">
                    <label class="form-label" for="adresse">Adressel</label>
                    <input type="email" name="adresse" id="adresse" class="form-control" placeholder="douala bonamoussadi" required>
                </div>

                <!-- Champ 4 : Filière -->
                <div class="mb-3">
                    <label class="form-label" for="classe">class</label>
                    <input type="text" name="classe" id="classe" class="form-control" placeholder="Informatique, Droit, etc." required>
                </div>

                <!-- Bouton Valider -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        Valider l'inscription
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>