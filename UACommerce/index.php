<?php
// Mostrar errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Definir la ruta base del proyecto
define('BASE_PATH', __DIR__);

// Incluir archivos necesarios
require_once BASE_PATH . '/config/Database.php';
require_once BASE_PATH . '/models/Usuario.php';
require_once BASE_PATH . '/controllers/UsuarioController.php';

// Inicializar la base de datos
$database = new Database();
$db = $database->getConnection();

// Procesar el registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new UsuarioController($db);
    $result = $controller->register($_POST);
    
    $success = $result['success'];
    $message = $result['message'];
}

// Mostrar la vista
require_once BASE_PATH . '/views/register.php';