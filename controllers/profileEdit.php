<?php
// Mostrar errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Definir la ruta base del proyecto
define('BASE_PATH', __DIR__);

// Incluir archivos necesarios
require_once BASE_PATH . '/../config/Database.php';
require_once BASE_PATH . '/../models/Usuario.php';
require_once BASE_PATH . '/../controllers/UsuarioController.php';

// Inicializar la base de datos
$database = new Database();
$db = $database->getConnection();

// Crear instancia del controlador
$controller = new UsuarioController($db);

// Iniciar sesión y verificar si el usuario ha iniciado sesión
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "No has iniciado sesión";
    exit;
}

// Obtener el perfil del usuario
$userId = $_SESSION['user_id'];
$userProfile = $controller->viewProfile($userId);

// Verificar si se obtuvo el perfil correctamente
if (!$userProfile['success']) {
    echo $userProfile['message'];
    exit;
}

// Pasar los datos a la vista
$userData = $userProfile['data'];
require_once BASE_PATH . '/../views/profileViewEdit.php';
