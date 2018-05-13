<?php
session_start();
?>
<!DOCTYPE html>
<?php
if (!$_SESSION['email']) {
    header("Location: inicio_de_sesion.html");
    
}
require 'encriptado.php';
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
                    Tus eventos en proceso :
                </h3>
                <?php
                $bdd = new PDO('mysql:host=localhost;dbname=eventum', 'root', '');
                $respuesta = $bdd->query('SELECT * FROM eventos WHERE DAY(inicio) = DAY(NOW()) AND eventos.nulo != 1 ORDER BY inicio');
                if ($respuesta != NULL) {
                    while ($donnees = $respuesta->fetch()) {
                        ?>
                        <div span style="float: left"> <h2> <?php echo '<p>' . $donnees['titulo'] . '</p>'; ?></h2></div>
                        <div span style="float: right"> <?php echo 'Fecha: <p>' . $donnees['inicio'] . '</p>'; ?></div>
                        <br><br><br><br>
                        <div class="col-md-2"> <?php echo '<p>Duracion: ' . $donnees['duracion'] . '</p>'; ?></div>
                        <div class="col-md-2"><?php echo '<p> Descripcion: ' . $donnees['descripcion'] . '</p>'; ?></div>
                        <div class="col-md-2"><?php echo '<p> Ubicacion: ' . $donnees['cupo_max'] . '</p>'; ?></div>
                        <div class="col-md-2"><?php echo '<p> Cupo maximo: ' . $donnees['ubicacion'] . '</p>'; ?></div><br><br>
                        <div class="col-md-2"><?php echo '<p> Precio: ' . $donnees['precio'] . '</p>'; ?></div>
                        <div class="col-md-2"><?php echo '<p> Presentador: ' . $donnees['presentador'] . '</p>'; ?> </div>
                        <div class="col-md-2"><?php echo '<p> Archivo: ' . $donnees['archivo']; ?></div>
                        <div class="col-md-2"><?php echo '<p> Asistente: ' . $donnees['asistente'] . '</p>'; ?></div>
                        <div class="col-sm-4" style="background-color:white;"> 
                        
                        <a class="btn btn-primary" href="controladorEventos.php?a=<?php echo encriptar_AES($donnees['id_evento'],$clave) ?>">Ver</a>
                                   
                            
                        </div>   
                        
                        <br><br>
                        <br>
                        <br>
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
                $respuesta = $bdd->query('SELECT * FROM eventos WHERE inicio > NOW() AND eventos.nulo != 1 ORDER BY inicio');
                if ($respuesta != NULL) {
                    while ($donnees = $respuesta->fetch()) {
                        ?>
                        <div span style="float: left"> <h2> <?php echo '<p>' . $donnees['titulo'] . '</p>'; ?></h2></div>
                        <div span style="float: right"> <?php echo 'Fecha: <p>' . $donnees['inicio'] . '</p>'; ?></div>
                        <br><br><br><br>
                        <div class="col-md-2"> <?php echo '<p>Duracion: ' . $donnees['duracion'] . '</p>'; ?></div>
                        <div class="col-md-2"><?php echo '<p> Descripcion: ' . $donnees['descripcion'] . '</p>'; ?></div>
                        <div class="col-md-2"><?php echo '<p> Ubicacion: ' . $donnees['cupo_max'] . '</p>'; ?></div>
                        <div class="col-md-2"><?php echo '<p> Cupo maximo: ' . $donnees['ubicacion'] . '</p>'; ?></div><br><br>
                        <div class="col-md-2"><?php echo '<p> Precio: ' . $donnees['precio'] . '</p>'; ?></div>
                        <div class="col-md-2"><?php echo '<p> Presentador: ' . $donnees['presentador'] . '</p>'; ?> </div>
                        <div class="col-md-2"><?php echo '<p> Archivo: ' . $donnees['archivo']; ?></div>
                        <div class="col-md-2"><?php echo '<p> Asistente: ' . $donnees['asistente'] . '</p>'; ?></div>
                        <br><br>
                        
                        
                        <div class="col-sm-4" style="background-color:white;"> 
                        
                        <a class="btn btn-primary" href="controladorEventos.php?a=<?php echo encriptar_AES($donnees['id_evento'],$clave) ?>">Ver</a>
                                   
                            
                        </div>   
                        
                        
                        <br>
                        <br>
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
                $respuesta = $bdd->query('SELECT * FROM eventos WHERE DAY(inicio) < DAY(NOW()) AND eventos.nulo != 1 ORDER BY inicio');
                if ($respuesta != NULL) {
                    while ($donnees = $respuesta->fetch()) {
                        ?>
                        <div span style="float: left"> <h2> <?php echo '<p>' . $donnees['titulo'] . '</p>'; ?></h2></div>
                        <div span style="float: right"> <?php echo 'Fecha: <p>' . $donnees['inicio'] . '</p>'; ?></div>
                        <br><br><br><br>
                        <div class="col-md-2"> <?php echo '<p>Duracion: ' . $donnees['duracion'] . '</p>'; ?></div>
                        <div class="col-md-2"><?php echo '<p> Descripcion: ' . $donnees['descripcion'] . '</p>'; ?></div>
                        <div class="col-md-2"><?php echo '<p> Ubicacion: ' . $donnees['cupo_max'] . '</p>'; ?></div>
                        <div class="col-md-2"><?php echo '<p> Cupo maximo: ' . $donnees['ubicacion'] . '</p>'; ?></div><br><br>
                        <div class="col-md-2"><?php echo '<p> Precio: ' . $donnees['precio'] . '</p>'; ?></div>
                        <div class="col-md-2"><?php echo '<p> Presentador: ' . $donnees['presentador'] . '</p>'; ?> </div>
                        <div class="col-md-2"><?php echo '<p> Archivo: ' . $donnees['archivo']; ?></div>
                        <div class="col-md-2"><?php echo '<p> Asistente: ' . $donnees['asistente'] . '</p>'; ?></div>
                        <br><br>
                        <div class="col-sm-4" style="background-color:white;"> 
                        
                        <a class="btn btn-primary" href="controladorEventos.php?a=<?php echo encriptar_AES($donnees['id_evento'],$clave) ?>">Ver</a>
                                   
                            
                        </div>   
                        <br>
                        <br>
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
