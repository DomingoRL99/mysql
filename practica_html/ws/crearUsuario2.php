<?php
    $host = '127.0.0.1';
    $user = 'root';
    $password = 'root';
    $dbname = 'colegio';

    $nombre = $_POST['nombre'] ?? null;
    $apellidos = $_POST['apellidos'] ?? null;
    $password2 = $_POST['password'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $email = $_POST['email'] ?? null;
    
    try {
        $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname . ';';
        $conexion = new PDO(
            $dsn,
            $user,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        try{
            $insert = 'INSERT INTO alumno (nombre, apellidos, password, telefono, email)
            VALUES ("'.$nombre.'" , "'.$apellidos.'", "'.$password2.'", "'.$telefono.'", "'.$email.'")';
            $consulta = $conexion->prepare($insert);
            $consulta->execute();
    
            $data = array(
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'password' => $password2,
                'telefono' => $telefono,
                'email' => $email
            );
            $message = 'Usuario creado correctamente';
            $success = true;
        } catch (PDOexception $ex) {
            echo 'error en la consulta';
        }
        
    } catch (PDOexception $e) {
        echo 'Base de datos no encontrada';
    }
    
    $json = array(
        'success' => $success,
        'message' => $message, 
        'data' => $data
    );
    echo json_encode($json);
?>