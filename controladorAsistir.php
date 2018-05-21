<?php

session_start();
if (!$_SESSION['email']) {
    header("Location: inicio_de_sesion.html");
}

function id_usuario($mostrar)  {

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql="select $mostrar from usuarios WHERE email = '{$_SESSION['email']}';";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($fila as $campo)  {   
            return $campo;
            }
        
    }
                    }

date_default_timezone_set('America/Argentina/Buenos_Aires');
require 'encriptado.php';
//CONSULTA A BD DE EVENTO
$servidor = "localhost";
$bd = "eventum";

$conexion = new PDO("mysql:host=$servidor;port=3306;dbname=$bd;charset=utf8", "root", "");

$id_evento = $_GET['id_evento'];
$id_usuario = id_usuario('id_usuario');

$sql = "INSERT INTO asistencia VALUES ('$id_usuario','$id_evento')";
$ejecucion = $conexion->prepare($sql);
$ejecucion->execute();
header("Location: mis_eventos.php");
?>