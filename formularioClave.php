<!DOCTYPE html>
<html >
<head>
    <title>EventUM</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script>
    function comprobarClave(){
        clave1 = document.nvaClave.contrasena.value
        clave2 = document.nvaClave.c_contrasena.value

        if (clave1 == clave2)
            document.nvaClave.submit()
            alert("verd")
            return true
        else
            alert("Las contraseñas no coinciden")
            document.nvaClave.reset()
            return false
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
            <h1>
               Nueva Clave             
            </h1>
               <?php
                require 'encriptado.php';
                $id = desencriptar_AES($_GET['a'],$clave);
                if(isset($id)){
                ?>
                    <form action="actualizarContrasena.php" name="nvaClave"  method="POST">
                    Nueva contraseña: <input type="password" name="contrasena" class="form-control" placeholder="Ingresa tu Nueva contraseña" required>
		            <div style="height: 10px;"></div>		
		            Confirmar contraseña: <input type="password" name="c_contrasena" class="form-control" placeholder="Confirmacion contraseña" required> 
		            <div style="height: 10px;"></div>
		            <input type="hidden" name="id" value="<?php echo $_GET['a'] ?>">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                <?php
                }else{
                    echo "Error de id de usuario";
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
