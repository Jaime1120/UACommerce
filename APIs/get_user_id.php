<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Usuario no autenticado'
    ]);
    http_response_code(401); // Unauthorized
    exit;
}

// Obtener el ID del usuario desde la sesión
$id_comprador = $_SESSION['user_id'];

// Responder con el ID del comprador
echo json_encode([
    'success' => true,
    'id_comprador' => $id_comprador
]);
exit;
