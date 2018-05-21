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
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMtQv2rF0nW7vo-M2LmsXI68SxizTSBt8&callback=initMap"></script>
		<script language="javascript" src="js/mapa.js"></script>
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
                    Crear Evento               
                </h1>
                <p>
                    <form action="almacenar_evento.php" method="POST" enctype="multipart/form-data">
                        
						<input type="text" name="titulo" class="form-control" placeholder="Titulo" required>
                        <div style="height: 10px;"></div>                   
                        
						<input type="datetime-local" name="fecha" class="control" placeholder="aaaa-mm-dd hh:mm" required>
                        
						<input type="text" name="duracion" placeholder="Duración en minutos" required>
                        <div style="height: 10px;"></div>		
                        
						<input type="text" name="descripcion" class="form-control" placeholder="Descripción" required>
                        <div style="height: 10px;"></div>		
                        
						<input type="text" name="cupo" placeholder="Cupo Máximo" required>
                        
						<input type="text" name="precio" placeholder="Precio" required>
                        <div style="height: 10px;"></div>
						
						<div class="form-group">
							<input type="file" name="archivo[]" class="form-control" multiple="" placeholder="Agregar archivos">
							<div style="height: 10px;"></div>
						</div>
						
						<div style="height: 500px" align="middle" > 
							<input type="text" id="direccion" name="direccion" size="40" value="" placeholder="Direccion"/>
							<input type="text" id="coordenadas" name="coordenadas" size="40" value="" placeholder="Coordenadas"/>
							</br>
							<span id="geocoding"></span>
							</br>
							<div id="map_canvas" style="width:70%; height:80%"></div>
						</div>
							
						<input type="submit" class="btn btn-primary" value="Crear Evento">
					</form>
				</p>            
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
	
