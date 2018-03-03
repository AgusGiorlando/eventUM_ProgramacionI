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
$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";
  

    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sq2="select id_usuario from usuarios WHERE email = '{$_SESSION['email']}';";
    $ejecutar=$conn->prepare($sq2);
    $ejecutar->execute();
    
    while($id=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($id as $id_usuario2)  {   
    $id_usuario=$id_usuario2;      
            }
        
    }

$sql = "UPDATE usuarios SET nombre='". $_POST['nombre'] ."', apellido='". $_POST['apellido'] ."', email='". $_POST['email'] ."', fecha_nacimiento='". $_POST['fecha'] ."', curriculum='". $_POST['curriculum'] ."',contraseña='". $_POST['c_contraseÃ±a'] ."' WHERE id_usuario=".$id_usuario;
$ejecucion = $conn->prepare($sql);
$ejecucion->execute();

$user=$_POST['email'];    
$_SESSION['email']=$user;    
header("Location: perfil.php");    
        
    ?>
</body>
</html>







