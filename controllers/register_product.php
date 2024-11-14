<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar los datos del formulario
    $nombre_producto = $conn->real_escape_string($_POST['nombre_producto']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);
    $precio = (float) $_POST['precio'];
    $id_categoria = (int) $_POST['id_categoria'];
    $stock = (int) $_POST['stock'];
    $imagen_url = $conn->real_escape_string($_POST['imagen_url']);

    // Aquí asigna el id del vendedor. Asegúrate de que este id exista en la tabla Usuarios.
    $id_vendedor = 1; // Reemplaza con el id del usuario vendedor existente.

    // Validación básica de campos obligatorios
    if (empty($nombre_producto) || empty($descripcion) || $precio <= 0 || $id_categoria <= 0 || $stock < 0) {
        $message = "Por favor completa todos los campos obligatorios con valores válidos.";
        $success = false;
    } else {
        // Preparar y ejecutar la consulta SQL
        $sql = "INSERT INTO Productos (id_vendedor, id_categoria, nombre_producto, descripcion, precio, stock, imagen_url)
                VALUES ($id_vendedor, $id_categoria, '$nombre_producto', '$descripcion', $precio, $stock, '$imagen_url')";

        if ($conn->query($sql) === TRUE) {
            $message = "Producto registrado exitosamente.";
            $success = true;
        } else {
            $message = "Error al registrar el producto: " . $conn->error;
            $success = false;
        }
    }

    // Cerrar la conexión
    $conn->close();
}

// Redireccionar de vuelta al formulario con el mensaje de éxito o error
header("Location: /UACommerce/index.php?message=" . urlencode($message) . "&success=" . urlencode($success));
exit();
?>
