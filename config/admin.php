<?php
require_once "auth.php";

if ($_SESSION["role"] !== "admin") {
    header("Location: /copi/index.php");
    exit;
}
