<?php
session_start();     // Ouvre la session
session_destroy();   // Supprime la session
header("Location: login.php"); // Retour au login
exit;
