<!DOCTYPE html>
<html>
<head>
    <title>EventUM</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script language = "javascript" src="js/validacion.js"></script>
    </head>
    <nav>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <img class="img-responsive" src="img/logo.png" >
                </div>
                
            </div>
            
        </div>
    </nav>
    <header>
        <div class="container">
            <div class="text-center row">  
                <h2>Registrarse</h2>
                <form action="agregarUsuario.php" method="post" name="nvaClave" onSubmit="return validar();" enctype="multipart/form-data">
                    Nombre: <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingresa tu nombre" required>
		            <div style="height: 10px;"></div>                   
		            Apellido: <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingresa tu apellido" required>
		            <div style="height: 10px;"></div>		
		            E-mail: <input type="text" name="email" id="email" class="form-control" placeholder="Ingresa tu E-imail" required>
		            <div style="height: 10px;"></div>		
                    Contraseña: <input type="password" name="contraseña" id="contrasena" class="form-control" placeholder="Ingresa tu contraseña" required>
		            <div style="height: 10px;"></div>		
		            Confirmar contraseña: <input type="password" name="c_contraseña" id="c_contrasena" class="form-control" placeholder="Confirmacion contraseña" required> 
		            <div style="height: 10px;"></div>
                    <button type="submit" class="btn btn-primary">Crear cuenta</button>
                </form>
            </div>
        </div>
        <br><br><br>
    </header>
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

	