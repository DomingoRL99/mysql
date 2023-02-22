<?php
    $host = '127.0.0.1';
    $user = 'root';
    $password = 'root';
    $dbname = 'colegio';

    $id = $_GET['id'] ?? null;
    
    try {
        $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname . ';';
        $conexion = new PDO(
            $dsn,
            $user,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        try{
            $select = 'SELECT id, nombre, apellidos, password, telefono, email FROM alumno WHERE id = :id';
            $consulta = $conexion->prepare($select);
            $consulta->bindParam(':id',$id,PDO::PARAM_INT);
            $consulta->execute();
    
            $data = $consulta->fetchAll(PDO::FETCH_ASSOC);

            $delete = 'DELETE FROM alumno WHERE id = :id';
            $consulta2 = $conexion->prepare($delete);
            $consulta2->bindParam(':id',$id,PDO::PARAM_INT);
            $consulta2->execute();

            $message = 'Usuario borrado correctamente';
            $success = true;
            if ($data == null){
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