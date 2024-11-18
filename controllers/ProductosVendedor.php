<?php
session_start();

define('BASE_PATH', __DIR__);


// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_name']) || !isset($_SESSION['user_type'])) {
    die("Acceso denegado. Inicia sesión para continuar.");
}

// Verificar el tipo de usuario
if ($_SESSION['user_type'] !== 'vendedor') {
    die("Acceso denegado. Solo los vendedores pueden acceder a esta página.");
}

require_once BASE_PATH . '/../views/VistaProductosVendedor.php';