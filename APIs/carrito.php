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

// Obtener el ID del comprador de la URL (ejemplo: Api.php?id_comprador=1)
$id_comprador = 2;

switch ($method) {
  // Obtener pedidos relacionados a un comprador por ID
  case 'GET':
    if ($id_comprador > 0) {
      // Consulta SQL para obtener los pedidos relacionados con el comprador
      $sql = "SELECT * FROM pedidos WHERE id_comprador = $id_comprador";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $pedidos = array();
        while ($row = $result->fetch_assoc()) {
          $pedidos[] = $row;
        }
        echo json_encode($pedidos);
      } else {
        echo json_encode(array('message' => 'No se encontraron pedidos para este comprador'));
      }
    } else {
      echo json_encode(array('message' => 'ID de comprador inválido'));
    }
    break;

  // Manejar otros métodos si es necesario
  default:
    echo json_encode(array('message' => 'Método no permitido'));
    break;
}

$conn->close();
?>
