<?php

session_start();

function mostrar($mostrar)  {

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
                    ?>

<?php
$texto=$_POST['pregunta'];       
$servidor = "localhost";
$bd = "eventum";
$a_donde=$_POST['a_donde'];
$usuario=mostrar("id_usuario");

echo $_POST['id'];

$conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8","root","");
$sql = "INSERT INTO preguntas (evento, usuario, texto) VALUES ('".$_POST['id']."', '".$usuario."', '".$texto."');";
$ejecucion = $conexion->prepare($sql);
$ejecucion->execute();
header("Location: $a_donde");

?>                   
