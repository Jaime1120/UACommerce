<?php
session_start();
require_once '../config/Database.php';
require_once '../models/Usuario.php';
require_once '../controllers/UsuarioController.php';

// Inicializar la base de datos
$database = new Database();
$db = $database->getConnection();

// Crear instancia del controlador
$controller = new UsuarioController($db);

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo "No has iniciado sesión";
    exit;
}

// Obtener el ID del usuario
$userId = $_SESSION['user_id'];

// Obtener los datos del formulario
$data = [
    'nombre' => $_POST['nombre'],
    'apellidos' => $_POST['apellidos'],
    'direccion' => $_POST['direccion'],
    'telefono' => $_POST['telefono'],
    'tipo_usuario' => $_POST['tipo_usuario'],
    'id_usuario' => $userId // Asegúrate de incluir el ID del usuario
];

// Llamar al método de actualización en el controlador
$result = $controller->updateProfile($data);

if ($result['success']) {
    // Actualización exitosa, destruir la sesión actual
    session_destroy(); // Destruir la sesión actual

    // Iniciar una nueva sesión
    session_start(); // Iniciar una nueva sesión

    // Guardar los nuevos datos en la sesión
    $_SESSION['user_id'] = $data['id_usuario'];
    $_SESSION['user_name'] = $data['nombre'];
    $_SESSION['user_type'] = $data['tipo_usuario'];

    // Guardar mensaje en la sesión
    $_SESSION['message'] = "Perfil actualizado exitosamente."; // Guardar mensaje en sesión

    // Redirigir a index.php
    header("Location: /UACommerce/index.php"); // Redirigir a index.php
    exit; // Asegurarse de salir después de la redirección
} else {
    echo "Error al actualizar el perfil: " . $result['message'];
}
?>