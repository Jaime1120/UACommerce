USE tienda;

INSERT INTO Usuarios (nombre, apellidos, correo_electronico, contrasena, direccion, telefono, tipo_usuario)
VALUES 
('Kibi', 'Nalgon', 'kibison@gmail.com', 'A123456789', 'Calle 123, Ciudad', '1234567890', 'vendedor');

INSERT INTO Categorias (nombre_categoria) VALUES 
('dulces'), ('postres'), ('bebidas'), ('comida'), ('papeleria'), ('bisuteria'), ('servicios'), ('libros');

-- Insertar productos de ejemplo
INSERT INTO Productos (id_vendedor, id_categoria, nombre_producto, descripcion, precio, stock, imagen_url)
VALUES 
(1, 1, 'Caramelo de Fresa', 'Delicioso caramelo sabor fresa.', 10.00, 100, ''),
(1, 2, 'Pastel de Chocolate', 'Pastel de chocolate esponjoso con cobertura de chocolate.', 150.00, 20, ''),
(1, 3, 'Café Americano', 'Café americano recién hecho, perfecto para iniciar el día.', 25.00, 50, ''),
(1, 4, 'Taco de Asada', 'Taco de carne asada con cilantro y cebolla.', 15.00, 100, ''),
(1, 5, 'Cuaderno Escolar', 'Cuaderno de 100 hojas, ideal para apuntes escolares.', 30.00, 200, ''),
(1, 6, 'Collar de Perlas', 'Hermoso collar de perlas para ocasiones especiales.', 250.00, 10, ''),
(1, 7, 'Servicio de Fotografía', 'Servicio de fotografía profesional para eventos.', 1000.00, 5, ''),
(1, 8, 'Libro de Cuentos', 'Libro de cuentos clásicos para niños.', 80.00, 50, '');