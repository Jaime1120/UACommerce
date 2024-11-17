<?php
// Mostrar errores en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Definir la ruta base del proyecto
define('BASE_PATH', __DIR__);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluir archivos necesarios
require_once BASE_PATH . '/../config/Database.php';
require_once BASE_PATH . '/../models/Usuario.php';
require_once BASE_PATH . '/../controllers/UsuarioController.php';

require '../Phpmailer/Exception.php';
require '../Phpmailer/PHPMailer.php';
require '../Phpmailer/SMTP.php';

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

        // Validar nombre (solo letras y espacios)
        if (!preg_match("/^[A-Za-zÀ-ÿ\s]+$/", $_POST['nombre'])) {
            throw new Exception("El nombre solo puede contener letras y espacios.");
        }

        // Validar correo electrónico
        if (!filter_var($_POST['correo_electronico'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Correo electrónico no válido.");
        }

        // Verificar dominio específico
        $allowedDomain = 'uacam.mx'; // Cambia esto al dominio permitido
        $emailDomain = substr(strrchr($_POST['correo_electronico'], "@"), 1);

        if ($emailDomain !== $allowedDomain) {
            throw new Exception("Solo se permite correos del dominio $allowedDomain");
        }

        // Validar contraseña (al menos 8 caracteres, una letra mayúscula y un número)
        if (!preg_match("/(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}/", $_POST['contrasena'])) {
            throw new Exception("La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula y un número.");
        }

        // Validar teléfono (opcional)
        if (!empty($_POST['telefono']) && !preg_match("/^\d{10}$/", $_POST['telefono'])) {
            throw new Exception("El teléfono debe contener 10 dígitos numéricos.");
        }
    

        // Guardar todos los datos del formulario en la sesión
        $_SESSION['user_data'] = [
            'nombre' => $_POST['nombre'],
            'apellidos' => $_POST['apellidos'],
            'correo_electronico' => $_POST['correo_electronico'],
            'contrasena' => $_POST['contrasena'],  // Sin hacer hash aún
            'direccion' => $_POST['direccion'],
            'telefono' => $_POST['telefono'],
            'tipo_usuario' => $_POST['tipo_usuario'],
        ];

        // Generar un código de verificación
        $verification_code = rand(100000, 999999);
        $expiration_time = time() + (10 * 60); // 10 minutos de validez
        $_SESSION['verification_code'] = $verification_code;
        $_SESSION['verification_expiration'] = $expiration_time;

        // Enviar correo con PHPMailer
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'uacommerce.server@gmail.com'; // Cambiar por el correo del sistema
            $mail->Password = 'kpch foxt otdm ksbp';                     // Cambiar por la contraseña
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Destinatario y contenido del correo
            $mail->setFrom('uacommerce.server@gmail.com', 'UACommerce');
            $mail->addAddress($_POST['correo_electronico']);
            $mail->isHTML(true);
            $mail->Subject = 'Código de Verificación';
            $mail->Body = "<p>Hola {$_POST['nombre']},</p>
                           <p>Gracias por registrarte en UACommerce. Usa este código para verificar tu cuenta:</p>
                           <h3>{$verification_code}</h3>
                           <p>Este código es válido por 10 minutos.</p>";

            $mail->send();
        } catch (Exception $e) {
            throw new Exception("No se pudo enviar el correo: {$mail->ErrorInfo}");
        }

        // Redirigir a la vista de verificación
        header('Location: /UACommerce/controllers/VerificationCode.php');
        exit();

    } catch (Exception $e) {
        $success = false;
        $message = "Error: " . $e->getMessage();
    }
}

// Mostrar la vista de registro
require_once BASE_PATH . '/../views/registerView.php';
?>
