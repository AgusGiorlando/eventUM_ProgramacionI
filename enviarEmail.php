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
        $link = "formularioClave.php?id=". $usuario[0]['id_usuario'];
        echo '<a href="' . $link . '">Cambiar Contraseña</a>'; 
    /*
        //EMAIL
        //Parametros
        $mensaje = "Linea 1\r\nLinea 2\r\nLinea3\r\n";
        $asunto = "Prueba de recuperacion de clave";
        $destino = "";
    
        //Cabeceras
        $cabecera = "MIME-Version: 1.0\r\n";
        $cabecera .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $cabecera .= "From: ";

        //Envio
        if(mail($destino,$asunto,$mensaje,$cabecera)){
            echo "<h1>Mensaje enviado</h1>";
        }else{
            echo "<h1>Mensaje no enviado</h1>";
        }
    */
    }else{
        echo "Email no encontrado";
    }
    ?>    
</body>
</html>
