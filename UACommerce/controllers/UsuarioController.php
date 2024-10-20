<?php
class UsuarioController {
    private $usuario;
    
    public function __construct($db) {
        $this->usuario = new Usuario($db);
    }
    
    public function register($data) {
        // Validación básica
        if(empty($data['nombre']) || empty($data['correo_electronico']) || empty($data['contrasena'])) {
            return ["success" => false, "message" => "Todos los campos obligatorios deben estar completos."];
        }

        // Asignar valores al modelo
        $this->usuario->nombre = $data['nombre'];
        $this->usuario->apellidos = $data['apellidos'];
        $this->usuario->correo_electronico = $data['correo_electronico'];
        $this->usuario->contrasena = $data['contrasena'];
        $this->usuario->direccion = $data['direccion'];
        $this->usuario->telefono = $data['telefono'];
        $this->usuario->tipo_usuario = $data['tipo_usuario'];

        // Verificar si el email ya existe
        if($this->usuario->emailExists()) {
            return ["success" => false, "message" => "Este correo electrónico ya está registrado."];
        }

        // Intentar crear el usuario
        if($this->usuario->create()) {
            return ["success" => true, "message" => "Usuario registrado exitosamente."];
        }
        
        return ["success" => false, "message" => "Error al crear el usuario. Por favor intente nuevamente."];
    }
}