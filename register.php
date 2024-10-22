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

// Inicializar variables
$success = false;
$message = '';

// Procesar el registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Validar campos requeridos
        $required_fields = ['nombre', 'correo_electronico', 'contrasena'];
        $missing_fields = [];
        
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                $missing_fields[] = $field;
            }
        }
        
        if (!empty($missing_fields)) {
            throw new Exception("Los siguientes campos son requeridos: " . implode(', ', $missing_fields));
        }

        // Inicializar la base de datos y el controlador
        $database = new Database();
        $db = $database->getConnection();
        $controller = new UsuarioController($db);

        // Intentar realizar el registro
        $result = $controller->register($_POST);
        
        $success = $result['success'];
        $message = $result['message'];
        
    } catch (Exception $e) {
        $success = false;
        $message = "Error: " . $e->getMessage();
    }
}

// Mostrar la vista de registro
require_once BASE_PATH . '/views/registerView.php';