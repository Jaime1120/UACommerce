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

        // Generar un código de verificación
        $verification_code = rand(100000, 999999);
        $expiration_time = time() + (10 * 60); // 10 minutos de validez

         // Guardar todos los datos del formulario en la sesión
         $_SESSION['user_data'] = [
            'nombre' => $_POST['nombre'],
            'apellidos' => $_POST['apellidos'],
            'correo_electronico' => $_POST['correo_electronico'],
            'contrasena' => $_POST['contrasena'],  // Sin hacer hash
            'direccion' => $_POST['direccion'],
            'telefono' => $_POST['telefono'],
            'tipo_usuario' => $_POST['tipo_usuario'],
        ];
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
            $mail->Subject = 'Codigo de Verificacion';
            $mail->Body = "<p>Hola {$_POST['nombre']},</p>
                           <p>Gracias por registrarte en UACommerce. Usa este codigo para verificar tu cuenta:</p>
                           <h3>{$verification_code}</h3>
                           <p>Este codigo es válido por 10 minutos.</p>";

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
