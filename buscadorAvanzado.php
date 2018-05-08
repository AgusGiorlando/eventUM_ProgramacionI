<?php
session_start();
if(!$_SESSION['email']){
    header("Location: inicio_de_sesion.html");
}
require 'encriptado.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>EventUM</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script language = "javascript" src="js/habilitar.js"></script>
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
                <h1>BUSQUEDA AVANZADA</h1>
                <form action="buscadorAvanzado.php" method="POST" id="form_BuscadorAv">
                    <div class="form-group row">
                        <div class="col-sm-1"><h4>Titulo</h4></div>
                        <div class="col-sm-1">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="check_titulo" unchecked onClick="habilitar('check_titulo','titulo');">
                             </div>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="titulo" name="titulo" disabled="disabled">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-1"><h4>Descripcion</h4></div>
                        <div class="col-sm-1">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="check_desc" unchecked onClick="habilitar('check_desc','desc');">
                             </div>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="desc" name="desc" disabled="disabled">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-1"><h4>Fecha</h4></div>
                        <div class="col-sm-1">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="check_fecha" unchecke d onClick="habilitar('check_fecha','fechai');habilitar('check_fecha','fechaf');">
                             </div>
                        </div>
                        <div class="col-sm-1">
                            <h4>Desde:</h4>
                        </div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="fechai" name="fechai" disabled="disabled">
                        </div>
                        <div class="col-sm-1">
                            <h4>Hasta:</h4>
                        </div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="fechaf" name="fechaf" disabled="disabled">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-1"><h4>Ubicacion</h4></div>
                        <div class="col-sm-1">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="check_ubi" unchecked onClick="habilitar('check_ubi','ubi');">
                             </div>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ubi" name="ubi" disabled="disabled">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-1"><h4>Precio</h4></div>
                        <div class="col-sm-1">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="check_precio" unchecked onClick="habilitar('check_precio','precio');">
                             </div>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="precio" name="precio" disabled="disabled">
                        </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-sm-1"><h4>Presentador</h4></div>
                        <div class="col-sm-1">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="check_pres" unchecke d onClick="habilitar('check_pres','n_pres');habilitar('check_pres','a_pres');">
                             </div>
                        </div>
                        <div class="col-sm-1">
                            <h4>Nombre:</h4>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="n_pres" name="n_pres" disabled="disabled">
                        </div>
                        <div class="col-sm-1">
                            <h4>Apellido:</h4>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="a_pres" name="a_pres" disabled="disabled">
                        </div>
                    </div>
                    <div class="container">
                        <div class="text-center row">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>
                </form>
                <hr>
                <?php        
                    $servidor = "localhost";
                    $bd = "eventum";
                                     
                    $conexion = new PDO("mysql:host=$servidor;port=3306;dbname=$bd;charset=utf8","root","");

                    $sql = "SELECT id_evento, titulo, inicio, duracion, precio, descripcion, ubicacion, usuarios.nombre, usuarios.apellido FROM eventos, usuarios WHERE 1 AND eventos.presentador = usuarios.id_usuario ";

                    if (isset($_POST['titulo'])) {
                        $sql .= "AND titulo LIKE '%".$_POST['titulo']."%' ";
                    }

                    if (isset($_POST['desc'])) {
                        $sql .= "AND descripcion LIKE '%".$_POST['desc']."%' ";
                    }

                    if (isset($_POST['fechai']) && isset($_POST['fechaf'])) {
                        $sql .= "AND inicio BETWEEN '".$_POST['fechai']."' AND '".$_POST['fechaf']."'";
                    }

                    if (isset($_POST['precio'])) {
                        $sql .= "AND precio LIKE '%".$_POST['precio']."%' ";
                    }
                    
                    if (isset($_POST['n_pres'])) {
                        $sql .= "AND usuarios.nombre LIKE '%".$_POST['n_pres']."%' ";
                    }
                                        
                    if (isset($_POST['a_pres'])) {
                        $sql .= "AND usuarios.apellido LIKE '%".$_POST['a_pres']."%' ";
                    }
                    
                    $sql .= ";";
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
                            <h5 style="color:black">Duracion: <?php echo $eventos[$i]['duracion'] ?></h5>
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
                            <a class="btn btn-primary" href="controladorEventos.php?a=<?php echo encriptar_AES($eventos[$i]['id_evento'],$clave) ?>">Leer mas</a>
                        </div>
                        <div class="col-sm-4" style="background-color:white;">    
                            <a class="btn btn-primary" href="">Asistir</a>
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
</body>
</html>
