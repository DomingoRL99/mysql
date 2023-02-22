<?php 
    require "interfaces/IToJson.php";
    require "models/User.php";

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $user = new User($nombre,$apellidos,$password,$telefono,$email);
    
    $texto = 'texto.txt';
    file_put_contents($texto,$user->toJson(),FILE_APPEND);
    
    echo $user->toJson();
?>