<!DOCTYPE html>
<html >
  

<head>
    
    <title>EventUM</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script>
        function comprobarClave(){
        contraseña1 = document.nvaClave.contraseña.value
        contraseña2 = document.nvaClave.c_contraseña.value
        
        if (contraseña1 == contraseña2)
            document.nvaClave.submit()
        else
            alert("Las contraseñas no coinciden")
            document.nvaClave.reset()
        } 
        
    </script>

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
 <form action="almacenar.php" method="post" name="nvaClave">
                Nombre: <input type="text" name="nombre" class="form-control" placeholder="Ingresa tu nombre" required>
		<div style="height: 10px;"></div>                   
		Apellido: <input type="text" name="apellido" class="form-control" placeholder="Ingresa tu apellido" required>
		<div style="height: 10px;"></div>		
		E-mail: <input type="text" name="email" class="form-control" placeholder="Ingresa tu E-imail" required>
		<div style="height: 10px;"></div>		
		Fecha de Nacimiento: <input type="date" name="fecha" class="form-control" placeholder="Ingresa tu fecha de nacimiento" required>
		<div style="height: 10px;"></div>		
                Foto: <input type="file" name="archivo" class="form-control" placeholder="Ingresa tu fecha de nacimiento" required>
		<div style="height: 10px;"></div>		
                Contraseña: <input type="password" name="contraseña" class="form-control" placeholder="Ingresa tu contraseña" required>
		<div style="height: 10px;"></div>		
		Confirmar contraseña: <input type="password" name="c_contraseña" class="form-control" placeholder="Confirmacion contraseña" required> 
		<div style="height: 10px;"></div>
		Curriculum: <textarea name="curriculum" rows="10" cols="40" class="form-control" placeholder="Ingresar datos del Curriculum" required></textarea>
                <div style="height: 10px;"></div>
                <button type="submit" class="btn btn-primary" onClick="comprobarClave()">Crear</button>
                
</form>
                
                
                
            </div>
        </div>
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

	