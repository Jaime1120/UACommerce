<?php
// Obtener compradores
$compradores = $conn->query("SELECT id_usuario, nombre FROM Usuarios WHERE tipo_usuario = 'comprador'");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar_pedido'])) {
    $id_comprador = $_POST['id_comprador'];
    $total = $_POST['total'];
    $estado = $_POST['estado'];

    $stmt = $conn->prepare("INSERT INTO Pedidos (id_comprador, total, estado) VALUES (?, ?, ?)");
    $stmt->bind_param("ids", $id_comprador, $total, $estado);

    if ($stmt->execute()) {
        echo "Pedido registrado con éxito.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<h2>Registro de Pedido</h2>
<form method="POST">
    <label>Comprador:</label>
    <select name="id_comprador">
        <?php while ($row = $compradores->fetch_assoc()): ?>
            <option value="<?= $row['id_usuario'] ?>"><?= $row['nombre'] ?></option>
        <?php endwhile; ?>
    </select><br>
    <label>Total:</label>
    <input type="number" name="total" step="0.01" required><br>
    <label>Estado:</label>
    <select name="estado">
        <option value="pendiente">Pendiente</option>
        <option value="pagado">Pagado</option>
        <option value="activo">Activo</option>
        <option value="entregado">Entregado</option>
        <option value="cancelado">Cancelado</option>
    </select><br>
    <button type="submit" name="registrar_pedido">Registrar Pedido</button>
</form>
