<?php

session_start();
if(!$_SESSION['email']){
    header("Location: inicio_de_sesion.html");

  }

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
                    <?php 
                   if(mostrar('admin')==1) {
                    ?>
                    <li><a href="administrador.php">Administrador</a></li> <!--Agregar link a mis eventos-->
                   <?php 
                   }
                   ?>
                    <li><a href="mis_eventos.php">Mis eventos</a></li> <!--Agregar link a mis eventos-->
                    <li><a href="perfil.php">Modificar Perfil</a></li>
                    <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
<header>
   <div class="container">
            <div class="text-center row">
                <h1>PAGINA PRINCIPAL</h1>
                <form class="form-inline" action="pagina_principal.php" id="form_buscador"  method="POST">
                    <div class="form-group">
                        <input type="text" name="busqueda" size="135" required
                        <?php
                        if(isset($_POST['busqueda'])) {
                            echo 'value="'.$_POST['busqueda'].'">';                            
                        }else{
                            echo'placeholder="Busqueda">';
                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                    <a class="btn btn-primary btn-sm" href="buscadorAvanzado.php">Avanzado</a>
                </form> 
                <hr>
                <?php
                    require 'encriptado.php';
                    date_default_timezone_set('America/Argentina/Buenos_Aires');
                    $servidor = "localhost";
                    $bd = "eventum";
                      
                    $conexion = new PDO("mysql:host=$servidor;port=3306;dbname=$bd;charset=utf8","root","");
                        
                    if(isset($_POST['busqueda'])) {
                        $sql = "SELECT id_evento, titulo, inicio, duracion, precio, descripcion, ubicacion, usuarios.nombre, usuarios.apellido FROM eventos, usuarios WHERE descripcion LIKE '%".$_POST['busqueda']."%' OR titulo LIKE '%".$_POST['busqueda']."%' AND inicio >= '".date('Y-m-d h:i:s', time())."' AND eventos.presentador = usuarios.id_usuario AND eventos.nulo != 1 ORDER BY inicio;";
                    }else{
                        $sql = "SELECT id_evento, titulo, inicio, duracion, precio, descripcion, ubicacion, usuarios.nombre, usuarios.apellido FROM eventos, usuarios WHERE inicio >= '".date('Y-m-d h:i:s', time())."' AND eventos.presentador = usuarios.id_usuario  AND eventos.nulo != 1 ORDER BY inicio";
                    }
                    $ejecucion = $conexion->prepare($sql);
                    $ejecucion->execute();
                    
                    $eventos = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
                    $numEventos = $ejecucion->rowCount();
                    
                    for ($i=0; $i < $numEventos; $i++) { 
                    
                ?>
                <!--EVENTO-->
                <div class="panel panel-primary">
                    <div class="panel-heading" style="background-color:white;">
                        <h3 style="color:black"><?php echo $eventos[$i]['titulo'] ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-4" style="background-color:white;">
                            <h5 style="color:black">Fecha: <?php echo $eventos[$i]['inicio'] ?></h5>
                        </div>
                        <div class="col-sm-8" style="background-color:white;">
                            <h5 style="color:black">Duracion: <?php echo $eventos[$i]['duracion'] ?> minutos</h5>
                        </div>
                    </div>
                    <div class="panel-body" style="background-color:white;padding:10px">
                        <h5 style="color:black" align="left"><?php echo $eventos[$i]['descripcion'] ?></h5>
                    </div>
                    <div class="panel-body" style="background-color:white;padding:10px">
                        <div class="col-sm-6" style="background-color:white;">    
                            <h5 style="color:black" align="left">Ubicacion: <?php echo $eventos[$i]['ubicacion'] ?></h5>
                        </div>
                        <div class="col-sm-6" style="background-color:white;">    
                            <h5 style="color:black" align="left">Precio: <?php echo $eventos[$i]['precio'] ?></h5>
                        </div>
                    </div>
                    <div class="panel-body" style="background-color:white;">
                        <div class="col-sm-4" style="background-color:white;">    
                            <h4 style="color:black" align="left"><?php echo $eventos[$i]['nombre']." ".$eventos[$i]['apellido'] ?></h4>
                        </div>
                        <div class="col-sm-4" style="background-color:white;">    
                            <a class="btn btn-primary" href="controladorEventos.php?a=<?php echo encriptar_AES($eventos[$i]['id_evento'],$clave) ?>" >Ver</a>
                        </div>
                        <div class="col-sm-4" style="background-color:white;">    
                            <a class="btn btn-primary" href="asistirEvento.php?a=<?php echo encriptar_AES($eventos[$i]['id_evento'],$clave) ?>">Asistir</a>
                        </div>
                    </div>
                </div>
                <!--EVENTO-->
                <?php
                }
                ?>
            </div>
        </div>
    </header>
   <footer>
        <div class="container">
            <div class="text-center row">
                Gracias por visitar la pagina<br>    
            </div>
        </div>
    </footer>
</body>
</html>
	