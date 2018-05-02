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
    $contrasena = password_hash($_POST['contraseña'],PASSWORD_DEFAULT);
    $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8","root","");
       
    $sql = "UPDATE usuarios SET contraseña= '".$contrasena."' WHERE id_usuario= '".desencriptar_AES($_POST['id'],$clave)."'";
    $ejecucion = $conexion->prepare($sql);
    $ejecucion->execute();

    $_SESSION['email']=$user;
    header("Location: inicio_de_sesion.html");    
    ?>
    <h2>Contraseña actualizada con exito</h2><br>
    <div class="we-do">
        <div class="container">
            <div class="text-center row">
                <a  class="btn" href="inicio_de_sesion.html">Iniciar sesion</a>
            </div>
        </div>
    </div>     
    <footer>
        <div class="container">
            <div class="text-center row">
                Gracias por visitar la pagina
                <br>   
            </div>
        </div>
    </footer>

</body>
</html>