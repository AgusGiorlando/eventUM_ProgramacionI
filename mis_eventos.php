<?php
session_start();
function verificar($mostrar, $id_usuario) {

    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $nombrebd = "eventum";

    $conn = new PDO("mysql:host=$servidor;dbname=$nombrebd", $usuario, $contrasena);
    $sql = "select $mostrar from asistencia WHERE usuario = '{$id_usuario}';";
    $ejecutar = $conn->prepare($sql);
    $ejecutar->execute();

    while ($fila = $ejecutar->fetch(PDO::FETCH_ASSOC)) {

        foreach ($fila as $campo) {
            return $campo;
        }
    }
}

function presentador($mostrar) {

    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $nombrebd = "eventum";

    $conn = new PDO("mysql:host=$servidor;dbname=$nombrebd", $usuario, $contrasena);
    $sql = "select $mostrar from eventos; ";
    $ejecutar = $conn->prepare($sql);
    $ejecutar->execute();

    while ($fila = $ejecutar->fetch(PDO::FETCH_ASSOC)) {

        foreach ($fila as $campo) {
            return $campo;
        }
    }
}
?>

<?php
if (!$_SESSION['email']) {
    header("Location: inicio_de_sesion.html");
}
date_default_timezone_set('America/Argentina/Buenos_Aires');
require 'encriptado.php';

function id_usuario($mostrar) {

    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $nombrebd = "eventum";

    $conn = new PDO("mysql:host=$servidor;dbname=$nombrebd", $usuario, $contrasena);
    $sql = "select $mostrar from usuarios WHERE email = '{$_SESSION['email']}';";
    $ejecutar = $conn->prepare($sql);
    $ejecutar->execute();

    while ($fila = $ejecutar->fetch(PDO::FETCH_ASSOC)) {

        foreach ($fila as $campo) {
            return $campo;
        }
    }
}
?>
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
                    <li>
                        <a href="pagina_principal.php">P&aacute;gina Principal</a>
                    </li>
                    <li>
                        <a href="nuevo_evento.php" style="background-color: red">Crear tu propio Evento</a>

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
                    MIS EVENTOS               

                </h1>
                <p>
                    <!--Espacio-->
                    <br>
                    Bienvenido en tu espacio <?php echo $_SESSION['email'] . ' !'; ?>
                    <br>
                    <br>
                    <br>
                </p>
            </div>
        </div>
    </header>
    <body>
        <div class="container">
            <div class="row">

                <h3>
                    Tus eventos hoy :
                </h3>
<?php
$id_usuario=id_usuario('id_usuario');
$presentador = presentador('presentador');
$verificar = verificar('usuario', $id_usuario);
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $nombrebd = "eventum";

    $bdd = new PDO("mysql:host=$servidor;dbname=$nombrebd", $usuario, $contrasena);
    

if ($verificar != "" || $presentador == $id_usuario) {
    $actualDate = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d h:i:s', time()));
    $actualString = $actualDate->format('Y-m-d H:i:s');

    $respuesta = $bdd->prepare("SELECT * FROM eventos WHERE DAY(inicio) = DAY(NOW()) AND eventos.nulo != 1 ORDER BY eventos.inicio");
    $respuesta->execute();

    $donnees = $respuesta->fetchAll(PDO::FETCH_ASSOC);
    $numDonnes = $respuesta->rowCount();

    for ($i = 0; $i < $numDonnes; $i++) {
        ?>
                        <div style="border: ridge black 2px;">
                            <div span style="float: left"> <h2> <?php echo '<p>' . $donnees[$i]['titulo'] . '</p>'; ?></h2></div>
                            <div span style="float: right"> <?php echo 'Fecha: <p>' . $donnees[$i]['inicio'] . '</p>'; ?></div>
                            <br><br><br><br>
                            <div class="col-md-2"> <?php echo '<p>Duracion: ' . $donnees[$i]['duracion'] . '</p>'; ?></div>
                            <div class="col-md-2"><?php echo '<p> Descripcion: ' . $donnees[$i]['descripcion'] . '</p>'; ?></div>
                            <div class="col-md-2"><?php echo '<p> Direccion: ' . $donnees[$i]['direccion'] . '</p>'; ?></div>
                            <div class="col-md-2"><?php echo '<p> Cupo maximo: ' . $donnees[$i]['cupo_max'] . '</p>'; ?></div><br><br>
                            <div class="col-md-2"><?php echo '<p> Precio: ' . $donnees[$i]['precio'] . '</p>'; ?></div>
                            <div class="col-md-2"><?php echo '<p> Presentador: ' . $donnees[$i]['presentador'] . '</p>'; ?> </div>
                            <div class="col-sm-4" style="background-color:white;"> 
                                <a class="btn btn-primary" href="controladorEventos.php?a=<?php echo encriptar_AES($donnees[$i]['id_evento'], $clave) ?>">Ver</a>
                            </div>


                            <br><br><br>
                            <br>
                            <br>
                        </div>                 
                        <br>
                        <br>

    <?php
    }

    $respuesta->closeCursor();
}
?>
                <br>
                <br>
            </div>
        </div>
        <div style="clear:both;"></div>
        <div class="container">
            <div class="row">
                <h3>
                    Tus eventos en futuro :
                </h3> 
<?php
if ($verificar != "" || $presentador == $id_usuario) {
    $actualDate = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d h:i:s', time()));
    $actualString = $actualDate->format('Y-m-d H:i:s');

    $respuesta = $bdd->prepare("SELECT * FROM eventos WHERE eventos.inicio > '" . $actualString . "' AND eventos.nulo != 1 ORDER BY eventos.inicio");
    $respuesta->execute();

    $donnees = $respuesta->fetchAll(PDO::FETCH_ASSOC);
    $numDonnes = $respuesta->rowCount();

    for ($i = 0; $i < $numDonnes; $i++) {
        ?>
                        <div style="border: ridge black 2px;">
                            <div span style="float: left"> <h2> <?php echo '<p>' . $donnees[$i]['titulo'] . '</p>'; ?></h2></div>
                            <div span style="float: right"> <?php echo 'Fecha: <p>' . $donnees[$i]['inicio'] . '</p>'; ?></div>
                            <br><br><br><br>
                            <div class="col-md-2"> <?php echo '<p>Duracion: ' . $donnees[$i]['duracion'] . '</p>'; ?></div>
                            <div class="col-md-2"><?php echo '<p> Descripcion: ' . $donnees[$i]['descripcion'] . '</p>'; ?></div>
                            <div class="col-md-2"><?php echo '<p> Direccion: ' . $donnees[$i]['direccion'] . '</p>'; ?></div>
                            <div class="col-md-2"><?php echo '<p> Cupo maximo: ' . $donnees[$i]['cupo_max'] . '</p>'; ?></div><br><br>
                            <div class="col-md-2"><?php echo '<p> Precio: ' . $donnees[$i]['precio'] . '</p>'; ?></div>
                            <div class="col-md-2"><?php echo '<p> Presentador: ' . $donnees[$i]['presentador'] . '</p>'; ?> </div>
                            <div class="col-sm-4" style="background-color:white;"> 
                                <a class="btn btn-primary" href="controladorEventos.php?a=<?php echo encriptar_AES($donnees[$i]['id_evento'], $clave) ?>">Ver</a>
                            </div>


                            <br><br><br>
                            <br>
                            <br>
                        </div>                 
                        <br>
                        <br>

        <?php
    }

    $respuesta->closeCursor();
}
?>
                <br>
                <br>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <h3>
                    Tus eventos pasados :
                </h3>
<?php
if ($verificar != "" || $presentador == $id_usuario) {
    $actualDate = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d h:i:s', time()));
    $actualString = $actualDate->format('Y-m-d H:i:s');

    $respuesta = $bdd->prepare("SELECT * FROM eventos WHERE eventos.inicio < '" . $actualString . "' AND eventos.nulo != 1 ORDER BY eventos.inicio");
    $respuesta->execute();

    $donnees = $respuesta->fetchAll(PDO::FETCH_ASSOC);
    $numDonnes = $respuesta->rowCount();

    for ($i = 0; $i < $numDonnes; $i++) {
        ?>
                        <div style="border: ridge black 2px;">
                            <div span style="float: left"> <h2> <?php echo '<p>' . $donnees[$i]['titulo'] . '</p>'; ?></h2></div>
                            <div span style="float: right"> <?php echo 'Fecha: <p>' . $donnees[$i]['inicio'] . '</p>'; ?></div>
                            <br><br><br><br>
                            <div class="col-md-2"> <?php echo '<p>Duracion: ' . $donnees[$i]['duracion'] . '</p>'; ?></div>
                            <div class="col-md-2"><?php echo '<p> Descripcion: ' . $donnees[$i]['descripcion'] . '</p>'; ?></div>
                            <div class="col-md-2"><?php echo '<p> Direccion: ' . $donnees[$i]['direccion'] . '</p>'; ?></div>
                            <div class="col-md-2"><?php echo '<p> Cupo maximo: ' . $donnees[$i]['cupo_max'] . '</p>'; ?></div><br><br>
                            <div class="col-md-2"><?php echo '<p> Precio: ' . $donnees[$i]['precio'] . '</p>'; ?></div>
                            <div class="col-md-2"><?php echo '<p> Presentador: ' . $donnees[$i]['presentador'] . '</p>'; ?> </div>
                            <div class="col-sm-4" style="background-color:white;"> 
                                <a class="btn btn-primary" href="controladorEventos.php?a=<?php echo encriptar_AES($donnees[$i]['id_evento'], $clave) ?>">Ver</a>
                            </div>


                            <br><br><br>
                            <br>
                            <br>
                        </div>                 
                        <br>
                        <br>

        <?php
    }

    $respuesta->closeCursor();
}
?>

                <br>
                <br>
            </div>
        </div>
    </body>
    <footer>
        <div class="container">
            <div class="text-center row">

                Gracias por visitar la pagina
                <br>    

            </div>
        </div>
    </footer>
</body>


</html>
