<?php
session_start();

$target_path = $_SESSION['target_path'];

function mostrar($mostrar){
		
	$servidor="localhost";
	$usuario="root";
	$contrasena="";
	$nombrebd="eventum";
	$conexionPDO = new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    
	$sql="SELECT $mostrar FROM eventos ORDER BY id_evento DESC LIMIT 1";
    $ejecutar=$conexionPDO->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
		foreach ($fila as $campo)  {   
			echo $campo;
		}		
    }
}

function mostrar_arch($mostrar){
	
	if (($target_path = $_SESSION['target_path']) == NULL){
		echo "NO SE CARGO";
	}
	if (($filename = $_SESSION['filename']) == NULL){
		echo "NO SE CARGO";
	}
	
	$servidor="localhost";
	$usuario="root";
	$contrasena="";
	$nombrebd="eventum";
	$conexionPDO = new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    
	$sql="SELECT $mostrar FROM eventos ORDER BY id_evento DESC LIMIT 1";
    $ejecutar=$conexionPDO->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {
		echo "<a href='$target_path'> $filename </a>";	
		echo "<br>";
	}
	$tipo = $_SESSION['tipo'];
	if ((strpos($tipo, "png") || strpos($tipo, "jpeg"))) {
		echo "<img src=$target_path border='0' width='300' height='300'>";
	}
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>EventUM</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
    </head>

    <nav>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <img class="img-responsive" src="img/logo.png" >
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="pagina_pricipal.php">Página Principal</a>
                    </li>
                    <li>
                        <a href="perfil.php">Perfil</a>
                    </li>
                    <li>
                     <a href="cerrar_sesion.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header>
        <div class="container">
            <div class="text-center row">
                <h1>
                    Mi Evento               
                </h1>
                <p>
                    <form action="modificar_evento.php" method="POST" enctype="multipart/form-data">
						<input type="text" name="titulo" class="form-control" placeholder="Titulo" value="<?php mostrar('titulo'); ?>" required>
                        <div style="height: 10px;"></div>                   
                        
						<input type="datetime-local" name="fecha" class="control" placeholder="Fecha" value="<?php mostrar('inicio'); ?>" required>
                        
						<input type="time" name="duracion" placeholder="Duración" value="<?php mostrar('duracion'); ?>" required>
                        <div style="height: 10px;"></div>		
                        
						<input type="text" name="descripcion" class="form-control" placeholder="Descripción" value="<?php mostrar('descripcion'); ?>" required>
                        <div style="height: 10px;"></div>		
                        
						<input type="text" name="cupo" placeholder="Cupo Máximo" value="<?php mostrar('cupo_max'); ?>" required>
                        
						<input type="text" name="precio" placeholder="Precio" value="<?php mostrar('precio'); ?>" required>
                        <div style="height: 10px;"></div>
						<?php
						
						mostrar_arch('archivo');
					 
						?>
						<div class="form-group">
							<input type="file" name="archivo[]" class="form-control" multiple="" placeholder="Agregar archivos">
							<div style="height: 10px;"></div>
						</div>
						
						<input type="text" name="ubicacion" class="form-control" placeholder="Ubicación" value="<?php mostrar('ubicacion'); ?>" required>
                        <div style="height: 10px;"></div>
						
						<input type="text" name="latitud" placeholder="Latitud" value="<?php mostrar('latitud'); ?>" required>		
                        
						<input type="text" name="longitud" placeholder="Longitud" value="<?php mostrar('longitud'); ?>" required>
                        <div style="height: 10px;"></div>
											
						<br/></br><br/><br><input type="submit" name="submit" value="Modificar Evento">
					</form>            
            </div>
        </div>
    </header>
   <footer>
        <div class="container">
            <div class="text-center row">
                Gracias por visitar la pagina  
            </div>
        </div>
    </footer>
</html>