<?php
    $mensaje = "Linea 1\r\nLinea 2\r\nLinea3\r\n";
    $asunto = "Prueba de recuperacion de clave";
    $destino = "a.giorlando@alumno.um.edu.ar";
    //Cabeceras
    $cabecera = "MIME-Version: 1.0\r\n";
    $cabecera .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $cabecera .= "From: agus.giorlando@gmail.com\r\n";

    if(mail($destino,$asunto,$mensaje,$cabecera)){
        echo "Mensaje enviado";
    }else{
        echo "Mensaje no enviado";
    }
?>