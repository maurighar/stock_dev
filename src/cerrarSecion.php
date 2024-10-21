<?php
require_once 'sys/funciones.php';
session_start();
session_unset();
session_destroy();
header("Location: " . RAIZ_SITIO . "index.php");
exit;
?>