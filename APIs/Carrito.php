<?php
header('Content-Type: application/json');
require_once '../models/CarritoModel.php';
require_once '../models/PedidoModel.php';

$carrito = new Carrito();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['product_id'], $data['quantity'])) {
            $carrito->add($data['product_id'], $data['quantity']);
            echo json_encode(['message' => 'Producto agregado al carrito']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Parámetros inválidos']);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['product_id'], $data['quantity'])) {
            $carrito->update($data['product_id'], $data['quantity']);
            echo json_encode(['message' => 'Cantidad actualizada']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Parámetros inválidos']);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $carrito->remove($_GET['id']);
            echo json_encode(['message' => 'Producto eliminado']);
        } else {
            $carrito->clear();
            echo json_encode(['message' => 'Carrito vaciado']);
        }
        break;

    case 'GET':
        echo json_encode($carrito->getItems());
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
        break;
}
?>
