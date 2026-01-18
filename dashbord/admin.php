<?php
require_once "../config/admin.php";
 require_once("../templates/header.php");
?>




<h2>📊 Dashboard Administrateur</h2>

<div class="row text-center">
    <div class="col-md-4">
        <a href="etudiants/liste.php" class="btn btn-primary w-100 p-4">
            👨‍🎓 Gérer Étudiants
        </a>
    </div>

    <div class="col-md-4">
        <a href="livres/index.php" class="btn btn-success w-100 p-4">
            📖 Gérer Livres
        </a>
    </div>

    <div class="col-md-4">
        <a href="emprunts/liste.php" class="btn btn-warning w-100 p-4">
            🔄 Gérer Emprunts
        </a>
    </div>
</div>

<?php require_once("../templates/footer.php"); ?>
