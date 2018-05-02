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
            <h1>
               Nueva Clave             
            </h1>
               <?php
                require 'encriptado.php';
                $id = desencriptar_AES($_GET['a'],$clave);
                if(isset($id)){
                ?>
               <form action="actualizarContrasena.php" method="post" name="nvaClave" enctype="multipart/form-data">

                            Nueva contraseña: <input type="password" name="contraseña" class="form-control" placeholder="Ingresa tu Nueva contraseña" required>
		            <div style="height: 10px;"></div>		
		            Confirmar contraseña: <input type="password" name="c_contraseña" class="form-control" placeholder="Confirmacion contraseña" required> 
		            <div style="height: 10px;"></div>
		            <input type="hidden" name="id" value="<?php echo $_GET['a'] ?>">
                            <button type="submit" class="btn btn-primary" onClick="comprobarClave()">Actualizar</button>

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
