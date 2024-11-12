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

// Obtener el ID del usuario de la URL (ejemplo: Api.php?id_usuario=1)
$id_usuario = 1;

switch ($method) {
  // Obtener productos relacionados a un usuario por ID
  case 'GET':
    if ($id_usuario > 0) {
      // Ajusta esta consulta según la relación entre productos y usuarios
      $sql = "SELECT p.* FROM productos p INNER JOIN usuario_productos up ON p.id_producto = up.id_producto WHERE up.id_usuario = $id_usuario";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $productos = array();
        while ($row = $result->fetch_assoc()) {
          $productos[] = $row;
        }
        echo json_encode($productos);
      } else {
        echo json_encode(array('message' => 'No se encontraron productos para este usuario'));
      }
    } else {
      echo json_encode(array('message' => 'ID de usuario inválido'));
    }
    break;

  // Manejar otros métodos si es necesario
  default:
    echo json_encode(array('message' => 'Método no permitido'));
    break;
}

$conn->close();
?>
