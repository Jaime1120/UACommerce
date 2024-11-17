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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .title {
            font-size: 3em;
            color: #1a2a44; /* Color azul */
            margin-bottom: 30px;
            text-align: center;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 1.8em;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"] {
            width: calc(100% - 20px);
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1em;
        }
        button {
            background-color: #1a2a44; /* Color azul */
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #FFD700; /* Color amarillo al pasar el cursor */
        }
        p {
            margin-top: 20px;
            color: #d9534f;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1 class="title">UACommerce</h1>
    <div class="container">
        <h1>Verificación de Código</h1>
        <form method="POST">
            <label for="verification_code">Ingrese el código enviado a su correo:</label>
            <input type="text" id="verification_code" name="verification_code" required>
            <button type="submit">Validar</button>
        </form>
        <?php if (isset($message)): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>