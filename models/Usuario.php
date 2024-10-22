<?php
class Usuario {
    private $conn;
    private $table_name = "Usuarios";

    public $id;
    public $nombre;
    public $apellidos;
    public $correo_electronico;
    public $contrasena;
    public $direccion;
    public $telefono;
    public $tipo_usuario;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function emailExists() {
        $query = "SELECT id_usuario FROM " . $this->table_name . " WHERE correo_electronico = :correo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':correo', $this->correo_electronico);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function getByEmail($email) {
        $query = "SELECT id_usuario, nombre, apellidos, correo_electronico, contrasena, tipo_usuario 
                 FROM " . $this->table_name . " 
                 WHERE correo_electronico = :correo";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':correo', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                (nombre, apellidos, correo_electronico, contrasena, direccion, telefono, tipo_usuario) 
                VALUES 
                (:nombre, :apellidos, :correo, :contrasena, :direccion, :telefono, :tipo_usuario)";

        $stmt = $this->conn->prepare($query);

        // Sanitizar los valores
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellidos = htmlspecialchars(strip_tags($this->apellidos));
        $this->correo_electronico = htmlspecialchars(strip_tags($this->correo_electronico));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->tipo_usuario = htmlspecialchars(strip_tags($this->tipo_usuario));
        
        // Encriptar contraseña
        $hashed_password = password_hash($this->contrasena, PASSWORD_BCRYPT);

        // Vincular los valores
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellidos', $this->apellidos);
        $stmt->bindParam(':correo', $this->correo_electronico);
        $stmt->bindParam(':contrasena', $hashed_password);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':tipo_usuario', $this->tipo_usuario);

        return $stmt->execute();
    }
}