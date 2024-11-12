<?php
// Obtener pedidos
$pedidos = $conn->query("SELECT id_pedido FROM Pedidos");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar_pago'])) {
    $id_pedido = $_POST['id_pedido'];
    $metodo_pago = $_POST['metodo_pago'];
    $estado_pago = $_POST['estado_pago'];
    $monto = $_POST['monto'];

    $stmt = $conn->prepare("INSERT INTO Pagos (id_pedido, metodo_pago, estado_pago, monto) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issd", $id_pedido, $metodo_pago, $estado_pago, $monto);

    if ($stmt->execute()) {
        echo "Pago registrado con éxito.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<h2>Registro de Pago</h2>
<form method="POST">
    <label>Pedido:</label>
    <select name="id_pedido">
        <?php while ($row = $pedidos->fetch_assoc()): ?>
            <option value="<?= $row['id_pedido'] ?>">Pedido #<?= $row['id_pedido'] ?></option>
        <?php endwhile; ?>
    </select><br>
    <label>Método de Pago:</label>
    <select name="metodo_pago">
        <option value="Efectivo">Efectivo</option>
        <option value="paypal">Paypal</option>
        <option value="transferencia_bancaria">Transferencia Bancaria</option>
    </select><br>
    <label>Estado de Pago:</label>
    <select name="estado_pago">
        <option value="pendiente">Pendiente</option>
        <option value="completado">Completado</option>
        <option value
