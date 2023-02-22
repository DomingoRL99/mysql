<?php
    $host = '127.0.0.1';
    $user = 'root';
    $password = 'root';
    $dbname = 'colegio';

    $id = $_GET['id'] ?? null;
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
            $select = 'SELECT * FROM alumno WHERE id = :id';
            $consulta = $conexion->prepare($select);
            $consulta->bindParam(':id',$id,PDO::PARAM_INT);
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

            $update = 'UPDATE alumno SET 
                nombre = "'.$nombre.'",  
                apellidos = "'.$apellidos.'",
                password = "'.$password2.'",
                telefono = "'.$telefono.'",
                email = "'.$email.'"
                WHERE id = :id';
            $consulta2 = $conexion->prepare($update);
            $consulta2->bindParam(':id',$id,PDO::PARAM_INT);
            $consulta2->execute();

            $data = array(
                'id' => $id,
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'password' => $password2,
                'telefono' => $telefono,
                'email' => $email
            );
            $message = 'Usuario modificado correctamente';
            $success = true;
            if ($resultados == null){
                $success = false;
                $message ='Usuario con id '.$id.' no encontrado';
                $data = null;
            }
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