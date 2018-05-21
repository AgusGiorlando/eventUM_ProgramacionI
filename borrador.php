<html>
    <head>
       
    </head>
    <body>
    
    <?php
$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

    $conexion = new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    echo $_GET['id'];
    $sql = "DELETE FROM usuarios WHERE id_usuario = '{$_GET['id']}';";
    $ejecucion = $conexion->prepare($sql);
    $ejecucion->execute();
    
    header("Location: administrador.php");
    ?>
               
    </body>
</html>
