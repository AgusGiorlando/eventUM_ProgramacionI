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
    //echo $_POST['email'];

    //VERIFICACION DE USUARIO
    $servidor = "localhost";
    $bd = "eventum";
    
    $conexion = new PDO("mysql:host=$servidor;port=3306;dbname=$bd;charset=utf8","root","");
    
    $sql = "SELECT * FROM usuarios WHERE email = '" . $_POST['email'] . "' ;";
    $ejecucion = $conexion->prepare($sql);
    $ejecucion->execute();

    $usuario = $ejecucion->fetchAll(PDO::FETCH_ASSOC);

    if(isset($usuario[0])){
        //GENERACION DE LINK
        require 'encriptado.php';
        
        $link = "formularioClave.php?a=". encriptar_AES($usuario[0]['id_usuario'],$clave);
        echo '<a href="' . $link . '">Cambiar contraseña</a><br>'; 
        //EMAIL
    }else{
        echo "Email no encontrado";
    }
    ?>    
</body>
</html>
