<?php
include('mostrarCarpeta.php');
function mostrar_evento($mostrar){
		
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

function mostrar_usuario($mostrar){
		
	include('conexionBD.php');
    
	$sql="SELECT $mostrar FROM usuarios ORDER BY id_usuario DESC LIMIT 1";
    $ejecutar=$conexionPDO->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
		foreach ($fila as $campo)  {   
			echo $campo;
		}		
    }
}

function mostrar_arch($mostrar){
	
	include ('conexionBD.php');
	
	if (($target_path = $_SESSION['target_path']) == NULL){
		echo "NO SE CARGO";
	}
	if (($filename = $_SESSION['filename']) == NULL){
		echo "NO SE CARGO";
	}
    
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
				<div align="center" style="border: ridge #ffffff 2px;">
					<div> <h1> <?php echo $evento[0]['titulo']; ?> </h1> </div>
					<div align="right"> <?php echo "De: "; echo $evento[0]['nombre']; echo " "; echo $evento[0]['apellido']; echo ".   "; ?> </div>
				</div>
				
				<div align="center"> <h2> <?php echo $evento[0]['descripcion']; ?> </h2> </div>
				
				<div style="width:500px; float:left;"> <h2> <?php echo "Fecha: "; echo $evento[0]['inicio']; ?> </h2> </div>
				
				<div style="width:500px; float:right;"> <h2> <?php echo "Duracion: "; echo $evento[0]['duracion']; echo " minutos"; ?> </h2> </div>
				
				<div style="width:500px; float:left;"> <h2> <?php echo "Cupo máximo: "; echo $evento[0]['cupo_max']; ?> </h2> </div>
				
				<div style="width:500px; float:right;"> <h2> <?php echo "Precio: "; echo $evento[0]['precio']; ?> </h2> </div>
                   
			</div>
            <div class="text-center row">
                <?php
					mostrarCarpeta((int)desencriptar_AES($_GET['a'],$clave));
				?>
                <div class="text-center row">
                    <?php echo $evento[0]['direccion']; ?>
                </div>
				<div style="height: 500px" align="center" > 
					<?php
					include('mapa_mostrar_1.php');
					?>
				</div>
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