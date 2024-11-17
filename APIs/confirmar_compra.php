<?php
session_start();
include '../config/Database.php'; // Archivo para la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);

    // Obtener la conexión PDO
    $database = new Database();
    $conn = $database->getConnection();

    // Verificar que la conexión se haya realizado correctamente
    if (!$conn) {
        die("Error de conexión: No se pudo conectar a la base de datos.");
    }

    // Iniciar una transacción
    $conn->beginTransaction();

    try {
        // 1. Obtener los datos del carrito del usuario
        $query_get_cart = "SELECT * FROM carrito WHERE id_comprador = ?";
        $stmt = $conn->prepare($query_get_cart);
        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si el carrito tiene productos
        if ($stmt->rowCount() > 0) {
            // 2. Insertar los datos en la tabla de pedidos
            $query_insert_order = "INSERT INTO pedidos (id_comprador, id_producto, cantidad, precio_unitario, fecha_pedido) VALUES (?, ?, ?, ?, NOW())";
            $stmt_insert = $conn->prepare($query_insert_order);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id_producto = $row['id_producto'];
                $cantidad = $row['cantidad'];
                $precio_unitario = $row['precio_unitario'];

                // Insertar cada producto del carrito en la tabla de pedidos
                $stmt_insert->bindParam(1, $user_id, PDO::PARAM_INT);
                $stmt_insert->bindParam(2, $id_producto, PDO::PARAM_INT);
                $stmt_insert->bindParam(3, $cantidad, PDO::PARAM_INT);
                $stmt_insert->bindParam(4, $precio_unitario, PDO::PARAM_STR);
                $stmt_insert->execute();
            }

            $stmt_insert = null;

            // 3. Eliminar los datos del carrito
            $query_delete_cart = "DELETE FROM carrito WHERE id_comprador = ?";
            $stmt_delete = $conn->prepare($query_delete_cart);
            $stmt_delete->bindParam(1, $user_id, PDO::PARAM_INT);
            $stmt_delete->execute();

            // Confirmar la transacción
            $conn->commit();

            // Redirigir al usuario con un mensaje de éxito
            $_SESSION['success_message'] = "Compra realizada con éxito.";
            header("Location: ../views/CarritoView.php");
            exit;

        } else {
            // Si el carrito está vacío
            throw new Exception("El carrito está vacío.");
        }

    } catch (Exception $e) {
        // Si ocurre un error, revertir la transacción
        $conn->rollBack();

        // Mostrar mensaje de error
        $_SESSION['error_message'] = "Error al procesar la compra: " . $e->getMessage();
        header("Location: ../views/CarritoView.php");
        exit;
    }

    // Cerrar la conexión
    $conn = null;
} else {
    // Redirigir si no hay datos enviados o usuario no está identificado
    $_SESSION['error_message'] = "No se pudo procesar la compra. Por favor intente nuevamente.";
    header("Location: ../views/CarritoView.php");
    exit;
}

// Al final de confirmar_compra.php, después de realizar la compra
$_SESSION['success_message'] = "Compra realizada con éxito.";
header("Location: ../views/CarritoView.php");
exit;

?>