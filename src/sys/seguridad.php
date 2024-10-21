<?php
if (!isset($_SESSION['user_id'])) {
    $raiz = RAIZ_SITIO;
    header("location:" . $raiz . "login.php");
    exit();
}