<?php
session_start();
?>
<html>
    <head>
       
    </head>
    <body>
		<?php
		include "conexionBD.php";
		
		$email = $_SESSION['email'];
		
		$titulo = $_POST['titulo'];
		$fecha = $_POST['fecha'];
		$duracion = $_POST['duracion'];
		$descripcion = $_POST['descripcion'];
		$cupo = $_POST['cupo'];
		$precio = $_POST['precio'];
		$id = preg_replace('([^A-Za-z0-9])', '', $_POST['id']);
        
		
		
				
		
		try{
			$sql = "UPDATE eventos SET titulo = :titulo, inicio = :inicio, duracion = :duracion, descripcion = :descripcion, cupo_max = :cupo_max, 
			precio = :precio WHERE id_evento=".$id;
			$stmt = $conexionPDO->prepare($sql);
			if($stmt->execute(array(
			':titulo' => $titulo, 
			':inicio' => $fecha, 
			':duracion' => $duracion,
			':descripcion' => $descripcion, 
			':cupo_max' => $cupo, 
			':precio' => $precio))){
//$id=$_POST['id'];				
//echo "Se ha creado el nuevo registro!";
				header("Location: administrador.php");
				die();
			}
		}catch(PDOException $e){
			echo "ERROR --->   " . $e;
		}
    
                
                
    ?>
               
    </body>
</html>
