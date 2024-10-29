<?php
require_once '../config/Database.php';

class Pedido {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function crearPedido($items, $comprador_id) {
        try {
            $this->db->beginTransaction();

            $total = 0;

            // Verificar stock y calcular total
            foreach ($items as $item) {
                $stmt = $this->db->prepare("SELECT precio, stock FROM Productos WHERE id_producto = ?");
                $stmt->execute([$item['product_id']]);
                $producto = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$producto || $producto['stock'] < $item['quantity']) {
                    throw new Exception("Stock insuficiente para el producto ID: " . $item['product_id']);
                }

                $total += $producto['precio'] * $item['quantity'];
            }

            // Insertar pedido
            $stmt = $this->db->prepare("INSERT INTO Pedidos (id_comprador, total) VALUES (?, ?)");
            $stmt->execute([$comprador_id, $total]);
            $id_pedido = $this->db->lastInsertId();

            // Insertar detalles del pedido
            foreach ($items as $item) {
                $stmt = $this->db->prepare(
                    "INSERT INTO Detalles_Pedido (id_pedido, id_producto, cantidad, precio_unitario, subtotal) 
                     VALUES (?, ?, ?, ?, ?)"
                );
                $subtotal = $producto['precio'] * $item['quantity'];
                $stmt->execute([$id_pedido, $item['product_id'], $item['quantity'], $producto['precio'], $subtotal]);

                // Actualizar stock
                $stmt = $this->db->prepare("UPDATE Productos SET stock = stock - ? WHERE id_producto = ?");
                $stmt->execute([$item['quantity'], $item['product_id']]);
            }

            $this->db->commit();
            return ['success' => true];
        } catch (Exception $e) {
            $this->db->rollBack();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
?>
