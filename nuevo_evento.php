<?php
session_start();
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
                    Crear Evento               
                </h1>
                <p>
                    <form action="almacenar_evento.php" method="POST" enctype="multipart/form-data">
                        
						<input type="text" name="titulo" class="form-control" placeholder="Titulo" required>
                        <div style="height: 10px;"></div>                   
                        
						<input type="datetime-local" name="fecha" class="control" placeholder="Fecha" value="aaaa-mm-dd hh:mm:ss"required>
                        
						<input type="time" name="duracion" placeholder="Duración" value="duracion"required>
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
						
						<input type="text" name="ubicacion" class="form-control" placeholder="Ubicación">
                        <div style="height: 10px;"></div>
						<head>
							<link rel="import" href="m1.php">
						</head>
						<input type="text" name="latitud" placeholder="Latitud">		
                        
						<input type="text" name="longitud" placeholder="Longitud">
                        <div style="height: 10px;"></div>
						
						<br/></br><br/><br><input type="submit" class="btn btn-primary" value="Crear Evento">
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
	
