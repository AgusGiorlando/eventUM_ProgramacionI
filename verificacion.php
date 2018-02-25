<?php
session_start();

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";
//variables user y password de la pagina inicial
$user=$_POST['email'];
$clave=$_POST['password'];    
    

//conetar base de datos
    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
//consultar base de datos
    
    $sql='SELECT id_usuario, nombre, apellido, fecha_nacimiento, foto, curriculum, contraseña FROM usuarios WHERE email= :email';
    $consulta=$conn->prepare($sql);
    $resultado=$consulta->execute(array(':email'=>$user));
    $rows=$consulta->fetchAll(\PDO::FETCH_OBJ);
    
    $sql1='SELECT id_usuario, nombre, apellido, email, fecha_nacimiento, foto, curriculum FROM usuarios WHERE contraseña= :password';
    $consulta1=$conn->prepare($sql1);
    $resultado1=$consulta1->execute(array(':password'=>$clave));
    $rows1=$consulta1->fetchAll(\PDO::FETCH_OBJ);
    
    if(count($rows) && count($rows1)){
         
        $_SESSION['email']=$user;
        header("Location: pagina_principal.php");    
         
    }else{   
        header("Location: inicio_de_sesion.html");   
        
    }
	