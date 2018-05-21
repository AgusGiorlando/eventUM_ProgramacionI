<?php
session_start();
if(!$_SESSION['email']){
    header("Location: inicio_de_sesion.html");
}
?>

<?php
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

include('mostrarCarpeta.php');
                    ?>

<!DOCTYPE html>
<html >
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
                    <li><a href="pagina_principal.php">Home</a></li>
                    <li><a href="mis_eventos.php">Mis eventos</a></li>
                    <li><a href="perfil.php">Modificar Perfil</a></li>
                    <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
<header>
   <div class="container">
            <div class="text-center row">
            <?php
            require 'encriptado.php';

$id=desencriptar_AES($_GET['a'],$clave);

 function mostrardatos($mostrar,$id)  {

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql = "SELECT $mostrar FROM eventos, usuarios WHERE id_evento = '".$id."' AND eventos.presentador = usuarios.id_usuario;";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($fila as $campo)  {   
return $campo;
            }
        
    }
                    }
                      
                    ?>  <br><br>
                
                    
                    
                    
                    <label for="texto" ><h1>Tu evento: </h1></label><br> 		
                                 
                    
                <label for="texto" >Titulo: </label> 		
                <textarea rows="0" cols="160" readonly="readonly"> <?php echo mostrardatos('titulo',$id); ?></textarea> <br><br>
                <label for="texto" >Inicio: </label> 		
                <input type="data" name="fecha" class="control" readonly="readonly" value="<?php echo mostrardatos('inicio',$id); ?>">    
                <label for="texto" >Duración: </label> 		
                <input type="data" name="duracion" placeholder="Duración" value="<?php echo mostrardatos('duracion',$id); ?>" readonly="readonly"> <br><br>  
                <label for="texto" >Descripción: </label> 		
                <textarea rows="5" cols="160" readonly="readonly"> <?php echo mostrardatos('descripcion',$id); ?></textarea> <br><br>
                <label for="texto" >Cupo Maximo:</label> 		
                <input type="text" name="cupo" class="control" value="<?php echo mostrardatos('cupo_max',$id); ?>" readonly="readonly">    
                <label for="texto" >Precio: </label> 		
                <input type="text" name="precio"  class="control" value="<?php echo "$".mostrardatos('precio',$id); ?>" readonly="readonly"> <br><br>
                <div style="height: 10px;"></div>		
		<?php
        	mostrarCarpeta((int)desencriptar_AES($_GET['a'],$clave));
		?>
                <div class="form-group">
                    <input type="file" name="archivo[]" class="form-control" multiple="" placeholder="Agregar archivos">
                    <div style="height: 10px;"></div>
		</div>
                <label for="texto" >Direccion: </label> 		
                <input type="text" name="direccion"  class="form-control" value="<?php echo mostrardatos('direccion',$id); ?>" readonly="readonly"> <br><br>
                <input type="hidden" name="id_evento" value="<?php echo desencriptar_AES($_GET['a'],$clave); ?>">

						
		<div  align="middle" > 
		<?php
		include('mapa_mostrar_1.php');
		?>
		</div>	
                <h3>Preguntas a responder</h3>
            <?php
  

$pasar_id_evento=$id;
$a_donde="eventoProPresentador.php?a=".$_GET['a']."";
include 'respuesta.php';
            
            ?>
              <br><br><br><br>
            </div>
        </div>
    </header>    
</body>
</html>
