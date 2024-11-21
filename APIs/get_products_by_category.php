<?php
header('Content-Type: application/json');
include '../config/Database.php';

$database = new Database();
$conn = $database->getConnection();

// Verificar que se haya pasado el parámetro 'category_id'
if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
    $category_id = intval($_GET['category_id']);  // Obtener el ID de la categoría desde la URL

    // Consultar los productos por categoría
    $query = "SELECT p.id_producto, p.nombre_producto, p.descripcion, p.precio, p.stock, p.imagen_url 
              FROM productos p
              JOIN categorias c ON p.id_categoria = c.id_categoria
              WHERE c.id_categoria = :category_id";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $stmt->execute();

    // Verificar si se encontraron productos
    if ($stmt->rowCount() > 0) {
        $productos = [];
        
        // Obtener todos los productos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $productos[] = $row;
        }

        // Enviar la respuesta en formato JSON
        echo json_encode([
            "success" => true,
            "data" => $productos
        ]);
    } else {
        // Si no se encontraron productos
        echo json_encode([
            "success" => false,
            "message" => "No se encontraron productos para esta categoría."
        ]);
    }
} else {
    // Si no se pasa el parámetro category_id
    echo json_encode([
        "success" => false,
        "message" => "El ID de la categoría es requerido."
    ]);
}

?>
