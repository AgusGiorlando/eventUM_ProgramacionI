<html>
    <head>
        <title>EventUM</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
    </head>
    <body>
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
            <?php
            require 'encriptado.php';

            $servidor = "localhost";
            $bd = "eventum";    
            $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8","root","");
    
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM usuarios WHERE email = '".$email."'";

            $ejecucion = $conexion->prepare($sql);
            $ejecucion->execute();
            $usuario = $ejecucion->fetchAll(PDO::FETCH_ASSOC);

            echo var_dump($usuario);
            echo "<br>".desencriptar_AES($usuario[0]['contraseña'],$clave);
            echo "<br>".$password;

            if(isset($usuario[0])){
                if(desencriptar_AES($usuario[0]['contraseña'],$clave) == $password){
                //session_start();
                //$_SESSION['email']=$_POST['email'];
                //header("Location: pagina_principal.php");    
                ?>
                <h1>Sesion iniciada</h1><br>
                <?php
                }else{   
                    ?>      
                    <h1>ERROR</h1><br>
                    <h2>Contraseña incorrecta</h2>
                    <div class="we-do">
                        <div class="container">
                            <div class="text-center row">
                                <a  class="btn" href="inicio_de_sesion.html">Volver</a>
                            </div>
                          </div>
                    </div>     
                    <?php
                }
            }else{
                ?>      
                <h1>ERROR</h1><br>
                <h2>Email incorrecto</h2>
                <div class="we-do">
                    <div class="container">
                        <div class="text-center row">
                            <a  class="btn" href="inicio_de_sesion.html">Volver</a>
                        </div>
                    </div>
                </div>     
            <?php
            }   
            ?>
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
