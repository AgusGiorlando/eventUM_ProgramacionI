<?php
function mostrar($mostrar)  {

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql="select $mostrar from usuarios WHERE id_usuario = '{$_POST['id']}';";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($fila as $campo)  {   
            return $campo;
            }
        
    }
                    }

?>
<?php
function mostrarimagen(){
$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

$conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
$sql="select foto from usuarios WHERE id_usuario = '{$_POST['id']}';";
$resultado=$conn->query($sql);
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
       
    return $fila['foto'];            
?>         
     <!--<img height="100px" src="data:imagen/jpg;base64,<?//php echo base64_encode($fila['foto']) ?>"/>-->
     
 <?php
        }
}

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
    $sq2="select id_usuario from usuarios WHERE id_usuario = '{$_POST['id']}';";
    $ejecutar=$conn->prepare($sq2);
    $ejecutar->execute();
    
    while($id=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($id as $id_usuario2)  {   
    $id_usuario=$id_usuario2;      
            }
        
    }
    




    
if($_FILES['archivo']['name']!=""){
$foto= addslashes(file_get_contents($_FILES['archivo']['tmp_name'])); 
$sq3 = "UPDATE usuarios SET foto='". $foto ."' WHERE id_usuario=".$id_usuario;
$ejecucion = $conn->prepare($sq3);
$ejecucion->execute();

    //echo 'Lleno ';
    
}else{

//   echo 'Vacio';
    
}
    
$comprobacion_cont=$_POST['contraseÃ±a'];

if ($comprobacion_cont!="") {
    
$password=password_hash($_POST['contraseÃ±a'],PASSWORD_DEFAULT);
    
} else {
    
$password=mostrar("contraseña");
    
}


$comprobacion__curr=$_POST['curriculum'];
    
if ($comprobacion__curr!="") {
$curriculum=$_POST['curriculum'];

} else {

$curriculum=mostrar("curriculum");
}


$sql = "UPDATE usuarios SET nombre='". $_POST['nombre'] ."', apellido='". $_POST['apellido'] ."', email='". $_POST['email'] ."', fecha_nacimiento='". $_POST['fecha'] ."', curriculum='". $curriculum ."',contraseña='". $password ."' WHERE id_usuario=".$id_usuario;
$ejecucion = $conn->prepare($sql);
$ejecucion->execute();

header("Location: administrador.php");    
        
    ?>
</body>
</html>







