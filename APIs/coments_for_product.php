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

// Obtener el ID del producto de la URL (ejemplo: Api.php?id_producto=1)
$id_producto = isset($_GET['id_producto']) ? intval($_GET['id_producto']) : 0;

switch ($method) {
  // Obtener comentarios relacionados a un producto por ID
  case 'GET':
    if ($id_producto > 0) {
      // Consulta SQL para obtener los comentarios relacionados con el producto
      $sql = "SELECT * FROM comentarios WHERE id_producto = $id_producto";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $comentarios = array();
        while ($row = $result->fetch_assoc()) {
          $comentarios[] = $row;
        }
        echo json_encode($comentarios);
      } else {
        echo json_encode(array('message' => 'No se encontraron comentarios para este producto'));
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
