<?php
// Iniciar la sesión
session_start();

// Configurar cabeceras CORS si es necesario
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    response(false, 'Usuario no autenticado', null, 401);
}

$id_comprador = $_SESSION['user_id'];

// Guardar en archivo de log para depuración (opcional)
file_put_contents('debug.log', "id_comprador: $id_comprador\n", FILE_APPEND);

// Verificar si el id_comprador es válido
if (!$id_comprador) {
    response(false, 'No se pudo obtener el id_comprador de la sesión', null, 500);
}

// Leer y decodificar el cuerpo de la solicitud (JSON)
$data = json_decode(file_get_contents('php://input'), true);

// Validar si el JSON tiene errores
if (json_last_error() !== JSON_ERROR_NONE) {
    response(false, 'Formato de JSON inválido', null, 400);
}

// Validar que se reciban los datos necesarios
if (!isset($data['id_producto'], $data['cantidad'])) {
    response(false, 'Datos incompletos: id_producto y cantidad son requeridos', null, 400);
}

// Asignar los datos recibidos a variables
$id_producto = $data['id_producto'];
$cantidad = $data['cantidad'];

// Validar que los datos sean válidos
if (!filter_var($id_producto, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) || 
    !filter_var($cantidad, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]])) {
    response(false, 'Datos inválidos: id_producto y cantidad deben ser enteros positivos', null, 400);
}

// Conectar a la base de datos
$host = 'localhost';
$dbname = 'tienda';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    response(false, 'Error al conectar con la base de datos: ' . $e->getMessage(), null, 500);
}

// Usar transacciones para evitar condiciones de carrera
$pdo->beginTransaction();

try {
    // Verificar si el producto ya está en el carrito
    $stmt = $pdo->prepare("SELECT id_carrito, cantidad FROM Carrito WHERE id_comprador = ? AND id_producto = ?");
    $stmt->execute([$id_comprador, $id_producto]);
    $carritoItem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($carritoItem) {
        // Si ya está en el carrito, actualizar la cantidad
        $nuevaCantidad = $carritoItem['cantidad'] + $cantidad;
        $updateStmt = $pdo->prepare("UPDATE Carrito SET cantidad = ? WHERE id_carrito = ?");
        $updateStmt->execute([$nuevaCantidad, $carritoItem['id_carrito']]);
    } else {
        // Si no está en el carrito, obtener precio del producto y agregarlo
        $precioUnitarioStmt = $pdo->prepare("SELECT precio FROM Productos WHERE id_producto = ?");
        $precioUnitarioStmt->execute([$id_producto]);
        $producto = $precioUnitarioStmt->fetch(PDO::FETCH_ASSOC);

        if (!$producto) {
            $pdo->rollBack(); // Deshacer la transacción
            response(false, 'Producto no encontrado', null, 404);
        }

        $precioUnitario = $producto['precio'];

        $insertStmt = $pdo->prepare("INSERT INTO Carrito (id_comprador, id_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
        $insertStmt->execute([$id_comprador, $id_producto, $cantidad, $precioUnitario]);
    }

    $pdo->commit(); // Confirmar la transacción
    response(true, 'Producto agregado al carrito', null, 200);
} catch (PDOException $e) {
    $pdo->rollBack(); // Deshacer la transacción en caso de error
    response(false, 'Error al procesar la solicitud: ' . $e->getMessage(), null, 500);
}

// Función para generar respuestas estándar
function response($success, $message, $data = null, $code = 200) {
    http_response_code($code);
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}
