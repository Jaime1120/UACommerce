<?php
header('Content-Type: application/json');

// Configuración de conexión a la base de datos
$host = 'localhost';
$db_name = 'uacommerce';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar si se recibió el id_comprador
    if (isset($_GET['id_comprador'])) {
        $id_comprador = intval($_GET['id_comprador']);

        $stmt = $conn->prepare("
            SELECT p.id_pedido, p.fecha, p.total, p.estado, dp.nombre_producto, dp.cantidad
            FROM pedidos p
            JOIN detalles_pedido dp ON p.id_pedido = dp.id_pedido
            WHERE p.id_comprador = :id_comprador
            ORDER BY p.fecha DESC
        ");
        $stmt->bindParam(':id_comprador', $id_comprador, PDO::PARAM_INT);
        $stmt->execute();

        $pedidos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id_pedido = $row['id_pedido'];

            if (!isset($pedidos[$id_pedido])) {
                $pedidos[$id_pedido] = [
                    'id_pedido' => $id_pedido,
                    'fecha' => $row['fecha'],
                    'total' => $row['total'],
                    'estado' => $row['estado'],
                    'productos' => []
                ];
            }

            $pedidos[$id_pedido]['productos'][] = [
                'nombre_producto' => $row['nombre_producto'],
                'cantidad' => $row['cantidad']
            ];
        }

        echo json_encode(array_values($pedidos));
    } else {
        echo json_encode(['message' => 'No se proporcionó el ID del comprador.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al conectar con la base de datos: ' . $e->getMessage()]);
}
?>
