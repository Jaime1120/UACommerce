<?php
class UsuarioController {
    private $usuario;
    
    public function __construct($db) {
        $this->usuario = new Usuario($db);
    }
    
    public function register($data) {
        if(empty($data['nombre']) || empty($data['correo_electronico']) || empty($data['contrasena'])) {
            return ["success" => false, "message" => "Todos los campos obligatorios deben estar completos."];
        }

        $this->usuario->nombre = $data['nombre'];
        $this->usuario->apellidos = $data['apellidos'];
        $this->usuario->correo_electronico = $data['correo_electronico'];
        $this->usuario->contrasena = $data['contrasena'];
        $this->usuario->direccion = $data['direccion'];
        $this->usuario->telefono = $data['telefono'];
        $this->usuario->tipo_usuario = $data['tipo_usuario'];

        if($this->usuario->emailExists()) {
            return ["success" => false, "message" => "Este correo electrónico ya está registrado."];
        }

        if($this->usuario->create()) {
            return ["success" => true, "message" => "Usuario registrado exitosamente."];
        }
        
        return ["success" => false, "message" => "Error al crear el usuario."];
    }

    public function login($email, $password) {
        if(empty($email) || empty($password)) {
            return ["success" => false, "message" => "Por favor ingrese correo y contraseña."];
        }

        $userData = $this->usuario->getByEmail($email);
        
        if($userData && password_verify($password, $userData['contrasena'])) {
            // Iniciar sesión
            session_start();
            $_SESSION['user_id'] = $userData['id_usuario'];
            $_SESSION['user_name'] = $userData['nombre'];
            $_SESSION['user_type'] = $userData['tipo_usuario'];
            
            return [
                "success" => true, 
                "message" => "Bienvenido " . $userData['nombre'],
                "user" => $userData
            ];
        }
        
        return ["success" => false, "message" => "Correo o contraseña incorrectos."];
    }

    public function logout() {
        session_start();
        session_destroy();
        return ["success" => true, "message" => "Sesión cerrada correctamente."];
    }
}