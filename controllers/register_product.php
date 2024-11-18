<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";

$conn = new mysqli($servername, $username, $password, $dbname);

session_start();

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre_producto = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $id_categoria = $_POST['id_categoria'];
    $stock = $_POST['stock'];
    $imagen_url = $_POST['imagen_url'];


    // Asigna el id del vendedor, asegúrate de que este id exista en la tabla Usuarios.
    $id_vendedor = $_SESSION['user_id']; // Reemplaza con el id del usuario vendedor existente.

    // Validación básica de campos obligatorios
    if (empty($nombre_producto) || empty($descripcion) || $precio <= 0 || $id_categoria <= 0 || $stock < 0) {
        $message = "Por favor completa todos los campos obligatorios con valores válidos.";
        $success = false;
    } else {
        // Preparar y ejecutar la consulta SQL con sentencias preparadas
        $stmt = $conn->prepare("INSERT INTO Productos (id_vendedor, id_categoria, nombre_producto, descripcion, precio, stock, imagen_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissdis", $id_vendedor, $id_categoria, $nombre_producto, $descripcion, $precio, $stock, $imagen_url);

        if ($stmt->execute()) {
            $message = "Producto registrado exitosamente.";
            $success = true;
        } else {
            $message = "Error al registrar el producto: " . $stmt->error;
            $success = false;
        }

        // Cerrar la declaración
        $stmt->close();
    }

    // Cerrar la conexión
    $conn->close();
}

// Redireccionar de vuelta al formulario con el mensaje de éxito o error
header("Location: /UACommerce/controllers/ProductosVendedor.php");
exit();
?>