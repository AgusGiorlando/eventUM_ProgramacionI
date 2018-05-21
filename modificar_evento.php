<?php
session_start();
?>
<html>
    <head>
       
    </head>
    <body>
		<?php
		include "conexionBD.php";
		
		
		$titulo = $_POST['titulo'];
		$fecha = $_POST['fecha'];
		$duracion = $_POST['duracion'];
		$descripcion = $_POST['descripcion'];
		$cupo = $_POST['cupo'];
		$precio = $_POST['precio'];
		$direccion = $_POST['direccion'];
		$coordenadas = $_POST['coordenadas'];
		$id_evento = preg_replace('([^A-Za-z0-9])', '', $_POST['id_evento']);

                
//echo $id_evento;
		
$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

$conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
 
$sql = "UPDATE eventos SET titulo='". $titulo ."', inicio='". $fecha ."', duracion='". $duracion ."', descripcion='". $descripcion ."', cupo_max='". $cupo ."',precio='". $precio ."',direccion='". $direccion ."',coordenadas='". $coordenadas ."' WHERE id_evento = '".$id_evento."';";
$ejecucion = $conn->prepare($sql);
$ejecucion->execute();

header("Location: mis_eventos.php");    
    ?>
               
    </body>
</html>
