<?php
session_start();
include '../config/Database.php'; // Asegúrate de incluir la conexión

// Verificar si el usuario está logueado
if (isset($_SESSION['user_id']) && isset($_GET['remove'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_GET['remove'];

    // Eliminar el producto del carrito
    $query = "DELETE FROM Carrito WHERE id_comprador = ? AND id_producto = ?";
    $stmt = $pdo->prepare($query);

    if ($stmt->execute([$user_id, $product_id])) {
        echo json_encode(['status' => 'success', 'message' => 'Producto eliminado con éxito']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Hubo un problema al eliminar el producto']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No se ha podido procesar la solicitud']);
}
?>
