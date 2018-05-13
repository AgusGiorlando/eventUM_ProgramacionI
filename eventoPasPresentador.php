<?php
session_start();
if(!$_SESSION['email']){
    header("Location: inicio_de_sesion.html");
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
            $servidor = "localhost";
            $bd = "eventum";
                      
            $conexion = new PDO("mysql:host=$servidor;port=3306;dbname=$bd;charset=utf8","root","");
                        
            $sql = "SELECT * FROM eventos, usuarios WHERE id_evento = '".desencriptar_AES($_GET['a'],$clave)."' AND eventos.presentador = usuarios.id_usuario;";
            $ejecucion = $conexion->prepare($sql);
            $ejecucion->execute();

            $evento = $ejecucion->fetchAll(PDO::FETCH_ASSOC);
            ?>
                <h1><?php echo $evento[0]['titulo']; ?></h1>
                <h3>Descripcion</h3>
                <?php echo $evento[0]['descripcion']; ?>
                <h3>Archivos</h3>
                <!--Archivos-->
                <input type="file" name="archivo[]" class="form-control" multiple="" placeholder="Agregar archivos">
                <h3>Preguntas</h3>
                <!--Preguntas-->
            </div>
        </div>
    </header>    
</body>
</html>
