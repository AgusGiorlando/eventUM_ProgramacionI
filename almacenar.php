<html>
    <head>
 
    </head>
    <body>
<?php
session_start();

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$email=$_POST['email'];
$fecha=$_POST['fecha'];
$password=$_POST['contraseÃ±a'];
$curriculum=$_POST['curriculum'];
$foto= addslashes(file_get_contents($_FILES['archivo']['tmp_name']));

    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    
    $sql='SELECT id_usuario, nombre, apellido, fecha_nacimiento, foto, curriculum, contraseña FROM usuarios WHERE email= :email';
    $consulta=$conn->prepare($sql);
    $resultado=$consulta->execute(array(':email'=>$email));
    $rows=$consulta->fetchAll(\PDO::FETCH_OBJ);
    
    if(count($rows)){
        header("Location: registrarse.php");   

        }else{   
try {         
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $conn->beginTransaction();
    
    $conn->exec("INSERT INTO usuarios (nombre, apellido, email, fecha_nacimiento, foto, curriculum, contraseña) 
    VALUES ('$nombre', '$apellido', '$email', '$fecha', '$foto', '$curriculum', '$password')");
    
    
    $conn->commit();
    echo "DATOS INGRESADOS CON EXITO";
 header("Location: inicio_de_sesion.html");   
    
    }
catch(PDOException $e)
    {
    // roll back the transaction if something failed
    $conn->rollback();
    echo "ERROR EN INGRESAR LOS DATOS";
    }

$conn = null;
     
        
    }
    

    ?>

    </body>
</html>
