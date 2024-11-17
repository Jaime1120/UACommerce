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
    die(json_encode(array("message" => "Connection failed: " . $conn->connect_error)));
}

// Obtener el método de solicitud
$method = $_SERVER['REQUEST_METHOD'];

// Obtener el id_comprador del query string (por ejemplo: ?id_comprador=1)
$id_comprador = isset($_GET['id_comprador']) ? intval($_GET['id_comprador']) : 0;

switch ($method) {
    case 'GET':
        if ($id_comprador > 0) {
            // Consulta para obtener los productos en el carrito del comprador
            $sql = "
                SELECT 
                    c.id_carrito,
                    c.id_producto,
                    p.nombre_producto,
                    c.cantidad,
                    c.precio_unitario,
                    (c.cantidad * c.precio_unitario) AS subtotal
                FROM 
                    Carrito c
                INNER JOIN 
                    Productos p ON c.id_producto = p.id_producto
                WHERE 
                    c.id_comprador = $id_comprador
            ";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $carrito = array();
                while ($row = $result->fetch_assoc()) {
                    $carrito[] = $row;
                }
                echo json_encode($carrito);
            } else {
                echo json_encode(array('message' => 'El carrito está vacío.'));
            }
        } else {
            echo json_encode(array('message' => 'ID del comprador inválido.'));
        }
        break;

    default:
        echo json_encode(array('message' => 'Método no permitido.'));
        break;
}

$conn->close();
?>
