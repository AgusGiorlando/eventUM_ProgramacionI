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
    //VERIFICACION DE USUARIO
    //MySQL
    $servidor = "localhost";
    $bd = "eventum";
    
    $conexion = new PDO("mysql:host=$servidor;port=3306;dbname=$bd;charset=utf8","root","");
    
    $sql = "SELECT * FROM usuarios WHERE email = pepe@e.com ;";
    $ejecucion = $conexion->prepare($sql);
    $ejecucion->execute();
    
    if(){

    }else{

    }

    //EMAIL
    //Parametros
    $mensaje = "Linea 1\r\nLinea 2\r\nLinea3\r\n";
    $asunto = "Prueba de recuperacion de clave";
    $destino = "a.giorlando@alumno.um.edu.ar";
    
    //Cabeceras
    $cabecera = "MIME-Version: 1.0\r\n";
    $cabecera .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $cabecera .= "From: agus.giorlando@gmail.com\r\n";

    //Envio
    if(mail($destino,$asunto,$mensaje,$cabecera)){
        echo "<h1>Mensaje enviado</h1>";
    }else{
        echo "<h1>Mensaje no enviado</h1>";
    }
    ?>    
</body>
</html>
