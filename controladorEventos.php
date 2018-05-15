<?php
session_start();
if(!$_SESSION['email']){
    header("Location: inicio_de_sesion.html");
}
date_default_timezone_set('America/Argentina/Buenos_Aires');
require 'encriptado.php';
//CONSULTA A BD DE EVENTO
$servidor = "localhost";
$bd = "eventum";
                      
$conexion = new PDO("mysql:host=$servidor;port=3306;dbname=$bd;charset=utf8","root","");
                        
$sql = "SELECT inicio, duracion, usuarios.email FROM eventos, usuarios WHERE id_evento = '".desencriptar_AES($_GET['a'],$clave)."' AND eventos.presentador = usuarios.id_usuario;";
$ejecucion = $conexion->prepare($sql);
$ejecucion->execute();

$evento = $ejecucion->fetchAll(PDO::FETCH_ASSOC);

// REDIRECCION A VISTA

$inicioDate = \DateTime::createFromFormat('Y-m-d H:i:s', $evento[0]['inicio']);
$actualDate = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d h:i:s', time()));

$diffInicio = $actualDate->diff($inicioDate);
$inicioDate->modify('+'.$evento[0]['duracion'].' minutes');
$diffFin = $actualDate->diff($inicioDate);

if($evento[0]['email'] == $_SESSION['email']){
    echo "Presentador";
    if($diffInicio->format('%R') == '+'){
        echo 'Futuro';
    }else{
        if($diffFin->format('%R') == '-'){
            header("Location: eventoPasPresentador.php?a=".$_GET['a']);
        }else if($diffFin->format('%R') == '+'){
            echo 'En Proceso';
        }
    }
}else{
    echo "Asistente";
    if($diffInicio->format('%R') == '+'){
        echo 'Futuro';
    }else{
        if($diffFin->format('%R') == '-'){
            header("Location: eventoPasAsistente.php?a=".$_GET['a']);        
        }else if($diffFin->format('%R') == '+'){
            echo 'En Proceso';
        }
    }
}
?>