<?php
// Obtener categorías y vendedores
$categorias = $conn->query("SELECT id_categoria, nombre_categoria FROM Categorias");
$vendedores = $conn->query("SELECT id_usuario, nombre FROM Usuarios WHERE tipo_usuario = 'vendedor'");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar_producto'])) {
    $nombre_producto = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $id_categoria = $_POST['id_categoria'];
    $id_vendedor = $_POST['id_vendedor'];
    $imagen_url = $_POST['imagen_url'];

    $stmt = $conn->prepare("INSERT INTO Productos (nombre_producto, descripcion, precio, stock, id_categoria, id_vendedor, imagen_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdiiss", $nombre_producto, $descripcion, $precio, $stock, $id_categoria, $id_vendedor, $imagen_url);

    if ($stmt->execute()) {
        echo "Producto registrado con éxito.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<h2>Registro de Producto</h2>
<form method="POST">
    <label>Nombre del Producto:</label>
    <input type="text" name="nombre_producto" required><br>
    <label>Descripción:</label>
    <textarea name="descripcion"></textarea><br>
    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" required><br>
    <label>Stock:</label>
    <input type="number" name="stock" required><br>
    <label>Categoría:</label>
    <select name="id_categoria">
        <?php while ($row = $categorias->fetch_assoc()): ?>
            <option value="<?= $row['id_categoria'] ?>"><?= $row['nombre_categoria'] ?></option>
        <?php endwhile; ?>
    </select><br>
    <label>Vendedor:</label>
    <select name="id_vendedor">
        <?php while ($row = $vendedores->fetch_assoc()): ?>
            <option value="<?= $row['id_usuario'] ?>"><?= $row['nombre'] ?></option>
        <?php endwhile; ?>
    </select><br>
    <label>URL de Imagen:</label>
    <input type="text" name="imagen_url"><br>
    <button type="submit" name="registrar_producto">Registrar Producto</button>
</form>
