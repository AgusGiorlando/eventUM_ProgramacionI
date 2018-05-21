<?php

session_start();

function mostrar($mostrar)  {

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql="select $mostrar from usuarios WHERE email = '{$_SESSION['email']}';";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($fila as $campo)  {   
return $campo;
            }
        
    }
                    }
                    ?>
<!DOCTYPE html>
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
                    </li>
                    
                </ul>
            </div>
            
        </div>
    </nav>
    <header>
        
        
    
   <div class="container">
            <div class="text-center row">

                <h1>
                </h1>
                <p>
<?php
$id=$_POST['id'];
$respuesta=$_POST['pregunta'];

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";
$donde=$_POST['a_donde'];

$conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
$sq3 = "UPDATE preguntas SET respuesta='". $respuesta ."' WHERE id_pregunta=".$id;
$ejecucion = $conn->prepare($sq3);
$ejecucion->execute();

header("Location: $donde");

?>                    <!--Espacio-->

<br>

                    <br>
                    <br>
                    <br>

                </p>
            </div>
        </div>
    </header>
    
</body>


</html>
