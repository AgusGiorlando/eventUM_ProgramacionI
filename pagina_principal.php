<?php
session_start();
?>
<!DOCTYPE html>
<?php
if(!$_SESSION['email']){
 header("Location: inicio_de_sesion.html");;
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
                        <a href="#">Titulo 1</a>
                    </li>
                    <li>
                        <a href="#">Titulo 2</a>
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
PAGINA PRINCIPAL               

                </h1>
                <p>
                    <!--Espacio-->
                    ...
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

                </p>
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
	