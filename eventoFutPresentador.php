<html>
	<head>
		<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMtQv2rF0nW7vo-M2LmsXI68SxizTSBt8&callback=initMap">
		</script>
	</head>
</html>

<?php
include('mostrarCarpeta.php');

function mostrar($mostrar){
		
	include('conexionBD.php');
    
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
	
	include('conexionBD.php');
    	
	$sql="SELECT $mostrar FROM eventos ORDER BY id_evento DESC LIMIT 1";
    $ejecutar=$conexionPDO->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {
		echo "<a href='$target_path'> $filename </a>";	
		echo "<br>";
	}
}

include ('conexionBD.php');
$sql = 'SELECT coordenadas FROM eventos ORDER BY id_evento DESC LIMIT 1';
$consulta = $conexionPDO->prepare($sql);
$resultado = $consulta->execute();
$rows = $consulta->fetchAll();
foreach($rows as $registro){
	$coordenadas = $registro[0];
}
					
$porcion = explode(",", $coordenadas);
$latitud = trim($porcion[0], '(');
$longitud = trim ($porcion[1], ')');

require 'encriptado.php';
$servidor = "localhost";
$bd = "eventum";                      
$conexion = new PDO("mysql:host=$servidor;port=3306;dbname=$bd;charset=utf8","root","");
$sql = "SELECT * FROM eventos, usuarios WHERE id_evento = '".desencriptar_AES($_GET['a'],$clave)."' AND eventos.presentador = usuarios.id_usuario;";
$ejecucion = $conexion->prepare($sql);
$ejecucion->execute();
$evento = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
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
                        <a href="pagina_principal.php">Página Principal</a>
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
						<input type="text" name="titulo" class="form-control" placeholder="Titulo" value="<?php echo $evento[0]['titulo']; ?>" required>
                        <div style="height: 10px;"></div>                   
                        
						<input type="datetime" name="fecha" class="control" placeholder="Fecha" value="<?php echo $evento[0]['inicio']; ?>" required>
                        
						<input type="text" name="duracion" placeholder="Duración en minutos" value="<?php echo $evento[0]['duracion']; ?>" required>
                        <div style="height: 10px;"></div>		
                        
						<input type="text" name="descripcion" class="form-control" placeholder="Descripción" value="<?php echo $evento[0]['descripcion']; ?>" required>
                        <div style="height: 10px;"></div>		
                        
						<input type="text" name="cupo" placeholder="Cupo Máximo" value="<?php echo $evento[0]['cupo_max']; ?>" required>
                        
						<input type="text" name="precio" placeholder="Precio" value="<?php echo $evento[0]['precio']; ?>" required>
                        <div style="height: 10px;"></div>
						
						<?php
						mostrarCarpeta((int)desencriptar_AES($_GET['a'],$clave));
						?>
                        <input type="hidden" name="id_evento" value="<?php echo desencriptar_AES($_GET['a'],$clave); ?>">
						<div class="form-group">
							<input type="file" name="archivo[]" class="form-control" multiple="" placeholder="Agregar archivos">
							<div style="height: 10px;"></div>
						</div>
						
						<div  align="middle" > 
							<?php
							include('mapa_mostrar.php');
							?>
						</div>	
						
						<input class="btn btn-primary" type="submit" name="submit" value="Modificar Evento">
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