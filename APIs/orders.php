<?php
header('Content-Type: application/json');

// Configuración de conexión a la base de datos
$host = 'localhost';
$db_name = 'tienda';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si se recibió el id_comprador
    if (isset($_GET['id_comprador'])) {
        $id_comprador = intval($_GET['id_comprador']);

        // Consulta para obtener los pedidos y sus detalles
        $stmt = $conn->prepare("
            SELECT 
                p.id_pedido, 
                p.fecha_pedido, 
                p.estado, 
                p.id_comprador, 
                pr.nombre_producto, 
                p.cantidad, 
                p.precio_unitario
            FROM pedidos p
            JOIN productos pr ON p.id_producto = pr.id_producto
            WHERE p.id_comprador = :id_comprador
            ORDER BY p.fecha_pedido DESC
        ");
        $stmt->bindParam(':id_comprador', $id_comprador, PDO::PARAM_INT);
        $stmt->execute();

        $pedidos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id_pedido = $row['id_pedido'];

            // Agrupar por pedido
            if (!isset($pedidos[$id_pedido])) {
                $pedidos[$id_pedido] = [
                    'id_pedido' => $id_pedido,
                    'fecha_pedido' => $row['fecha_pedido'],
                    'estado' => $row['estado'],
                    'productos' => []
                ];
            }

            // Añadir los productos al pedido
            $pedidos[$id_pedido]['productos'][] = [
                'nombre_producto' => $row['nombre_producto'],
                'cantidad' => $row['cantidad'],
                'precio_unitario' => $row['precio_unitario'],
                'subtotal' => $row['cantidad'] * $row['precio_unitario']
            ];
        }

        echo json_encode(array_values($pedidos));
    } else {
        echo json_encode(['message' => 'No se proporcionó el ID del comprador.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al conectar con la base de datos: ' . $e->getMessage()]);
}
