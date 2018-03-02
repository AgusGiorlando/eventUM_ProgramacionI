<html>
    <head>
       
    </head>
    <body>
    
    <?php
$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$email=$_POST['email'];
$fecha=$_POST['fecha'];
$contraseña=$_POST['contraseña'];
$curriculum=$_POST['curriculum'];
$foto= $_FILES["foto"];

    $conexion1 = new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    
    $sql = "UPDATE usuarios SET nombre = :nombre, 
            apellido = :apellido, 
            email = :email,  
            fecha_nacimiento = :fecha,  
            foto = :foto,
            curriculum = :curriculum,
            contrase�a = :contraseña,
WHERE id = :id";
$stmt = $conexion1->prepare($sql);                                  
$stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);       
$stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);    
$stmt->bindParam(':email', $email, PDO::PARAM_STR);       
$stmt->bindParam(':fecha_nacimiento', $fecha, PDO::PARAM_STR);    
$stmt->bindParam(':foto', $foto, PDO::PARAM_STR);       
$stmt->bindParam(':curriculum', $curriculum, PDO::PARAM_STR);    
$stmt->bindParam(':contrase�a', $contraseña, PDO::PARAM_STR);       
$stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);    


$stmt->bindParam(':id', $id, PDO::PARAM_INT);   
$stmt->execute(); 
 
header("Location: pagina_principal.php");
    ?>
               
    </body>
</html>
