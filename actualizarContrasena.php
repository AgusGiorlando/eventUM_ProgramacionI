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
    $servidor = "localhost";
    $bd = "eventum";
       
    $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8","root","");
        
    $sql = "UPDATE usuarios SET contraseña='". $_POST['contrasena'] ."' WHERE id_usuario=".$_POST['id'];
    $ejecucion = $conexion->prepare($sql);
    $ejecucion->execute();

    $_SESSION['email']=$user;
    header("Location: inicio_de_sesion.html");    
        
    ?>
</body>
</html>