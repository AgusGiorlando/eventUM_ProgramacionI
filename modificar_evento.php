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
		$ubicacion = $_POST['ubicacion'];
		$latitud = $_POST['latitud'];
		$longitud = $_POST['longitud'];
		$cupo = $_POST['cupo'];
		$precio = $_POST['precio'];
		
		foreach($_FILES['archivo']['tmp_name'] as $key => $tmp_name){
			//Validamos que el archivo exista
			if($_FILES['archivo']['name'][$key]){
				$filename = $_FILES['archivo']['name'][$key]; //Obtenemos el nombre original del archivo
				$_SESSION['filename'] = $filename;
				$source = $_FILES['archivo']['tmp_name'][$key]; //Obtenemos un nombre temporal del archivo
				$directorio = 'docs'; //Declaramos un  variable con la ruta donde guardaremos los archivos
				//Validamos si la ruta de destino existe, en caso de no existir la creamos
				if(!file_exists($directorio)){
					mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
				}
		
				$dir = opendir($directorio); //Abrimos el directorio de destino
				$target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo
				$_SESSION['target_path'] = $target_path;
		
				//Movemos y validamos que el archivo se haya cargado correctamente
				//El primer campo es el origen y el segundo el destino
				if(move_uploaded_file($source, $target_path)) {	
					echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
				} else{	
					echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
				}
				closedir($dir); //Cerramos el directorio de destino
			}
		}
		
		$sql = 'SELECT * FROM usuarios WHERE email = :email';
		$consulta = $conexionPDO->prepare($sql);
		$resultado = $consulta->execute(array(':email'=>$email));
		$rows = $consulta->fetchAll();
		foreach($rows as $registro){
			$id_usuario = $registro[0];
			//echo $id_usuario;
		}		
		
		try{
			$sql = "UPDATE eventos SET titulo = :titulo, inicio = :inicio, duracion = :duracion, descripcion = :descripcion, cupo_max = :cupo_max, ubicacion = :ubicacion, 
			latitud = :latitud, longitud = :longitud, precio = :precio, presentador = :presentador, archivo = :archivo";
			$stmt = $conexionPDO->prepare($sql);
			if($stmt->execute(array(
			':titulo' => $titulo, 
			':inicio' => $fecha, 
			':duracion' => $duracion,
			':descripcion' => $descripcion, 
			':cupo_max' => $cupo, 
			':ubicacion' => $ubicacion,
			':latitud' => $latitud, 
			':longitud' => $longitud,
			':precio' => $precio, 
			':presentador' => $id_usuario,
			':archivo' => $target_path))){
				//echo "Se ha creado el nuevo registro!";
				header("Location: mi_evento.php");
				die();
			}
		}catch(PDOException $e){
			echo "ERROR --->   " . $e;
		}
    
    ?>
               
    </body>
</html>
