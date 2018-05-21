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
            $servidor = "localhost";
            $bd = "eventum";

            $nombre=$_POST['nombre'];
            $apellido=$_POST['apellido'];
            $email=$_POST['email'];
            $password = password_hash($_POST['contraseña'],PASSWORD_DEFAULT);

            $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8","root","");
    
            $sql='SELECT * FROM usuarios WHERE email= :email';
            $consulta=$conexion->prepare($sql);
            $resultado=$consulta->execute(array(':email'=>$email));
            $rows=$consulta->fetchAll(\PDO::FETCH_OBJ);    

            if(count($rows)){
        ?>      
                <h1>ERROR</h1><br>
                <h2>La direccion de e-mail ingresada ya pertenece a un usuario</h2>
                <div class="we-do">
                    <div class="container">
                        <div class="text-center row">
                            <a  class="btn" href="registrarse.php">Volver</a>
                        </div>
                    </div>
                </div>     
        <?php
            }else{   
                $sql = "INSERT INTO usuarios (nombre, apellido, email, contraseña) VALUES ('".$nombre."', '".$apellido."', '".$email."', '".$password."');";
                $ejecucion = $conexion->prepare($sql);
                $ejecucion->execute();
        ?>      
                <h1>BIENVENIDO!</h1><br>
                <div class="we-do">
                    <div class="container">
                        <div class="text-center row">
                            <a  class="btn" href="inicio_de_sesion.html">Iniciar sesion</a>
                        </div>
                    </div>
                </div>     
        <?php
            }
        ?>
        </div>
    </div>
        <br><br><br><br><br><br><br><br><br>
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
