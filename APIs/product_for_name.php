<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(array('error' => 'Error de conexión: ' . $conn->connect_error)));
}

// Obtener el método de solicitud
$method = $_SERVER['REQUEST_METHOD'];

// Obtener el nombre del producto de la URL
$nombre_producto = isset($_GET['nombre']) ? trim($_GET['nombre']) : '';

if ($method === 'GET') {
    if (!empty($nombre_producto)) {
        // Evitar inyección SQL con declaraciones preparadas
        $stmt = $conn->prepare("SELECT * FROM productos WHERE nombre_producto = ?");
        $stmt->bind_param("s", $nombre_producto);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $producto = $result->fetch_assoc();
            echo json_encode($producto);
        } else {
            echo json_encode(array('message' => 'Producto no encontrado'));
        }
        $stmt->close();
    } else {
        echo json_encode(array('message' => 'Nombre de producto inválido'));
    }
} else {
    echo json_encode(array('message' => 'Método no permitido'));
}

$conn->close();
?>
