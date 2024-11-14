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

// Obtener el ID de la categoría de la URL o establecer uno predeterminado
$id_categoria = 1;

switch ($method) {
  // Obtener productos por categoría
  case 'GET':
    if ($id_categoria > 0) {
      $sql = "SELECT * FROM productos WHERE id_categoria = $id_categoria";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $productos = array();
        while ($row = $result->fetch_assoc()) {
          $productos[] = $row;
        }
        echo json_encode($productos);
      } else {
        echo json_encode(array('message' => 'No se encontraron productos en esta categoría'));
      }
    } else {
      echo json_encode(array('message' => 'ID de categoría inválido'));
    }
    break;

  // Manejar otros métodos si es necesario
  default:
    echo json_encode(array('message' => 'Método no permitido'));
    break;
}

$conn->close();
?>
