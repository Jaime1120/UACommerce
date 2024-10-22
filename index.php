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

// Crear instancia del controlador
$controller = new UsuarioController($db);

// Procesar el login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['email']) && isset($_POST['password'])) {
        $result = $controller->login($_POST['email'], $_POST['password']);
        $success = $result['success'];
        $message = $result['message'];
        
        if($success) {
            // Redirigir al dashboard o página principal después del login
            header("Location: /UACommerce/dashboard.php");
            exit;
        }
    }
}

// Mostrar la vista de login
require_once BASE_PATH . '/views/loginView.php';