<?php 
    
    class User implements ITojson{
        public $nombre;
        public $apellidos;
        public $password;
        public $telefono;
        public $email;

        public function __construct($nombre,$apellidos,$password,$telefono,$email){
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->password = $password;
            $this->telefono = $telefono;
            $this->email = $email;
        }
        
        public function get_nombre(){
            return $this->nombre;
        }
        public function get_apellidos(){
            return $this->apellidos;
        }
        public function get_password(){
            return $this->password;
        }
        public function get_telefono(){
            return $this->telefono;
        }
        public function get_email(){
            return $this->email;
        }
        public function set_nombre($nombre){
            $this->nombre = $nombre;
        }
        public function set_apellidos($apellidos){
            $this->apellidos = $apellidos;
        }
        public function set_password($password){
            $this->password = $password;
        }
        public function set_telefono($telefono){
            $this->telefono = $telefono;
        }
        public function set_email($email){
            $this->email = $email;
        }

        public function toJson(){
            $json = array(
                'nombre' => $this->nombre,
                'apellidos' => $this->apellidos, 
                'contrasenya' => $this->password,
                'telefono' => $this->telefono, 
                'email' => $this->email
            );
            return json_encode($json);
        }
        
    }
 
?>
