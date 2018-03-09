<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php

    //CAMBIO DE CONTRASEÑA
    require 'encriptado.php';

    $servidor = "localhost";
    $bd = "eventum";
    $contrasena = encriptar_AES($_POST['contrasena'],$clave);
    $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8","root","");
       
    $sql = "UPDATE usuarios SET contraseña= '".encriptar_AES($_POST['contrasena'],$clave)."' WHERE id_usuario= '".desencriptar_AES($_POST['id'],$clave)."'";
    $ejecucion = $conexion->prepare($sql);
    $ejecucion->execute();

    $_SESSION['email']=$user;
    header("Location: inicio_de_sesion.html");         
    ?>
</body>
</html>