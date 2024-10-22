<?php
class UsuarioController {
    private $usuario;
    
    public function __construct($db) {
        $this->usuario = new Usuario($db);
    }
    
    public function register($data) {
        // Validar campos obligatorios
        if (empty($data['nombre']) || empty($data['correo_electronico']) || empty($data['contrasena'])) {
            return ["success" => false, "message" => "Todos los campos obligatorios deben estar completos."];
        }
    
        // Validar nombre
        if (!preg_match("/^[A-Za-zÀ-ÿ\s]+$/", $data['nombre'])) {
            return ["success" => false, "message" => "El nombre solo puede contener letras y espacios."];
        }
    
        // Validar correo electrónico
        if (!filter_var($data['correo_electronico'], FILTER_VALIDATE_EMAIL)) {
            return ["success" => false, "message" => "Correo electrónico no válido."];
        }
    
 // Validar contraseña (al menos 8 caracteres, una letra mayúscula y un número)
        if (!preg_match("/(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}/", $data['contrasena'])) {
            return ["success" => false, "message" => "La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula y un número."];
        }

    
        // Validar teléfono (opcional)
        if (!empty($data['telefono']) && !preg_match("/^\d{10}$/", $data['telefono'])) {
            return ["success" => false, "message" => "El teléfono debe contener 10 dígitos numéricos."];
        }
    
        // Validar si el correo electrónico ya está registrado
        if ($this->usuario->emailExists()) {
            return ["success" => false, "message" => "Este correo electrónico ya está registrado."];
        }
    
        // Asignar datos al usuario
        $this->usuario->nombre = $data['nombre'];
        $this->usuario->apellidos = $data['apellidos'];
        $this->usuario->correo_electronico = $data['correo_electronico'];
        $this->usuario->contrasena = $data['contrasena'];
        $this->usuario->direccion = $data['direccion'];
        $this->usuario->telefono = $data['telefono'];
        $this->usuario->tipo_usuario = $data['tipo_usuario'];
    
        // Intentar crear el usuario
        if ($this->usuario->create()) {
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