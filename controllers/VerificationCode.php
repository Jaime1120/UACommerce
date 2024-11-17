<?php
session_start();

define('BASE_PATH', __DIR__);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_code = $_POST['verification_code'];

    // Verificar que el código coincida y no haya expirado
    if (
        isset($_SESSION['verification_code']) &&
        isset($_SESSION['verification_expiration']) &&
        $_SESSION['verification_code'] == $entered_code &&
        time() <= $_SESSION['verification_expiration']
    ) {
        // Código válido, proceder al registro
        require_once BASE_PATH . '/../config/Database.php';
        require_once BASE_PATH . '/../models/Usuario.php';
        require_once BASE_PATH . '/../controllers/UsuarioController.php';

        $database = new Database();
        $db = $database->getConnection();
        $controller = new UsuarioController($db);

        // Obtener los datos del usuario almacenados temporalmente en la sesión
        $user_data = $_SESSION['user_data'];

        // Registrar al usuario
        $register_result = $controller->register($user_data);

        if ($register_result['success']) {
            // Limpiar sesión y redirigir al login
            session_unset();
            session_destroy();
            header('Location: /UACommerce/controllers/login.php');
            exit();
        } else {
            $message = $register_result['message'];
        }
    } else {
        $message = "El código es inválido o ha expirado. Por favor, intenta registrarte nuevamente.";
        session_unset();
        session_destroy();
        header('Location: /UACommerce/controllers/register.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificar Código</title>
</head>
<body>
    <h1>Verificación de Código</h1>
    <form method="POST">
        <label for="verification_code">Ingrese el código enviado a su correo:</label>
        <input type="text" id="verification_code" name="verification_code" required>
        <button type="submit">Validar</button>
    </form>
    <?php if (isset($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
</body>
</html>
