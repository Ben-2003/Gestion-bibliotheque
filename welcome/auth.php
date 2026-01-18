<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: pages/login.php"); // adapte le chemin si besoin
    exit;
}
