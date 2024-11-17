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
            // Consulta para obtener los detalles del pedido filtrados por id_comprador
            $sql = "
                SELECT 
                    dp.id_detalle,
                    p.id_pedido,
                    p.fecha_pedido,
                    p.total AS total_pedido,
                    prod.id_producto,
                    prod.nombre_producto,
                    dp.cantidad,
                    dp.precio_unitario,
                    dp.subtotal
                FROM 
                    Detalles_Pedido dp
                INNER JOIN 
                    Pedidos p ON dp.id_pedido = p.id_pedido
                INNER JOIN 
                    Productos prod ON dp.id_producto = prod.id_producto
                WHERE 
                    p.id_comprador = $id_comprador
            ";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $detalles = array();
                while ($row = $result->fetch_assoc()) {
                    $detalles[] = $row;
                }
                echo json_encode($detalles);
            } else {
                echo json_encode(array('message' => 'No se encontraron detalles de pedidos para este comprador.'));
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