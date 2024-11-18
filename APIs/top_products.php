<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión: " . $conn->connect_error]));
}

// Consulta SQL para obtener los productos más vendidos
$sql = "
    SELECT 
        p.id_producto, 
        p.nombre_producto, 
        p.imagen_url, 
        p.precio, 
        SUM(pe.cantidad) AS total_vendido
    FROM Productos p
    JOIN Pedidos pe ON p.id_producto = pe.id_producto
    GROUP BY p.id_producto, p.nombre_producto, p.imagen_url, p.precio
    ORDER BY total_vendido DESC
    LIMIT 10;
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
} else {
    echo json_encode([]);
}

$conn->close();
?>
