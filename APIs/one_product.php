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
  die("Connection failed: " . $conn->connect_error);
}

// Obtener el método de solicitud
$method = $_SERVER['REQUEST_METHOD'];

// Obtener el ID del producto de la URL (ejemplo: Product.php?id=1)
$id_producto = isset($_GET['id']) ? (int)$_GET['id'] : 0;

switch ($method) {
  // Obtener un producto por ID
  case 'GET':
    if ($id_producto > 0) {
      $sql = "SELECT * FROM productos WHERE id_producto = $id_producto";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
        echo json_encode($producto);
      } else {
        echo json_encode(array('message' => 'Producto no encontrado'));
      }
    } else {
      echo json_encode(array('message' => 'ID de producto inválido'));
    }
    break;

  // Manejar otros métodos si es necesario
  default:
    echo json_encode(array('message' => 'Método no permitido'));
    break;
}

$conn->close();
?>
