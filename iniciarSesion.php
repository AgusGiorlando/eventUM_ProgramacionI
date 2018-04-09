<?php
session_start();

require 'encriptado.php';

$servidor = "localhost";
$bd = "eventum";
//variables user y password de la pagina inicial
$user=$_POST['email'];
$password= encriptar_AES($_POST['password'],$clave);    
    
//conetar base de datos
$conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8","root","");
//consultar base de datos
    
    $sql='SELECT * FROM usuarios WHERE email= :email';
    $consulta=$conexion->prepare($sql);
    $resultado=$consulta->execute(array(':email'=>$user));
    $rows=$consulta->fetchAll(\PDO::FETCH_OBJ);
    
    $sql1='SELECT * FROM usuarios WHERE contrase�a= :password';
    $consulta1=$conexion->prepare($sql1);
    $resultado1=$consulta1->execute(array(':password'=>$clave));
    $rows1=$consulta1->fetchAll(\PDO::FETCH_OBJ);
    
    if(count($rows) && count($rows1)){
         
        $_SESSION['email']=$user;
        //header("Location: pagina_principal.php");    
        echo "Sesion iniciada";
    }else{   
        echo "Error";
        //header("Location: inicio_de_sesion.html");           
    }