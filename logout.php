<?php
session_start();
session_unset();
session_destroy();
header("Location: /UACommerce/index.php"); // Redirige al inicio o login
exit;
?>