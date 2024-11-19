<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Usuario no autenticado']);
    http_response_code(401); // Unauthorized
    exit;
}

// Obtener el id_comprador desde la sesión
$id_comprador = $_SESSION['user_id'];

// Leer y decodificar el cuerpo de la solicitud (JSON)
$data = json_decode(file_get_contents('php://input'), true);

// Validar que se reciban los datos necesarios
if (!isset($data['id_producto'], $data['cantidad'])) {
    echo json_encode(['error' => 'Datos incompletos']);
    http_response_code(400); // Bad Request
    exit;
}

// Asignar los datos recibidos a variables
    
$id_producto = $data['id_producto'];
$cantidad = $data['cantidad'];

// Conectar a la base de datos
$host = 'localhost';
$dbname = 'tienda';
$username = 'root'; // Cambiar según tu configuración
$password = ''; // Cambiar según tu configuración

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al conectar con la base de datos: ' . $e->getMessage()]);
    http_response_code(500); // Internal Server Error
    exit;
}

// Verificar si el producto ya está en el carrito
try {
    $stmt = $pdo->prepare("SELECT id_carrito, cantidad FROM Carrito WHERE id_comprador = ? AND id_producto = ?");
    $stmt->execute([$id_comprador, $id_producto]);
    $carritoItem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($carritoItem) {
        // Si ya está en el carrito, actualizar la cantidad
        $nuevaCantidad = $carritoItem['cantidad'] + $cantidad;
        $updateStmt = $pdo->prepare("UPDATE Carrito SET cantidad = ? WHERE id_carrito = ?");
        $updateStmt->execute([$nuevaCantidad, $carritoItem['id_carrito']]);
    } else {
        // Si no está en el carrito, agregarlo
        $precioUnitarioStmt = $pdo->prepare("SELECT precio FROM Productos WHERE id_producto = ?");
        $precioUnitarioStmt->execute([$id_producto]);
        $producto = $precioUnitarioStmt->fetch(PDO::FETCH_ASSOC);

        if (!$producto) {
            echo json_encode(['error' => 'Producto no encontrado']);
            http_response_code(404); // Not Found
            exit;
        }

        $precioUnitario = $producto['precio'];

        $insertStmt = $pdo->prepare("INSERT INTO Carrito (id_comprador, id_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
        $insertStmt->execute([$id_comprador, $id_producto, $cantidad, $precioUnitario]);
    }

    echo json_encode(['success' => true, 'message' => 'Producto agregado al carrito']);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al procesar la solicitud: ' . $e->getMessage()]);
    http_response_code(500); // Internal Server Error
    exit;
}
