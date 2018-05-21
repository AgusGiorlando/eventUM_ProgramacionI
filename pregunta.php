<?php
  



header("refresh:60; url=$a_donde"); //Refrescamos cada 300 segundos

function usuario($mostrar,$id)  {

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql="select $mostrar from usuarios WHERE email = '{$id}';";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($fila as $campo)  {   
            return $campo;
            }
        
    }
                    }
function otro_usuario($mostrar,$id)  {

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql="select $mostrar from usuarios WHERE id_usuario = '{$id}';";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($fila as $campo)  {   
            return $campo;
            }
        
    }
                    }
                   

function pregunta($mostrar,$id_evento)  {

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql="select $mostrar from preguntas WHERE  id_pregunta= '{$id_evento}' ;";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($fila as $campo)  {   
?>
<?php return $campo;    





}
        
    }
                    }
function mis_respuesta($mostrar,$id_evento)  {

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";
    $id_usuario=usuario('id_usuario',$_SESSION['email']);
    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql="select $mostrar from preguntas WHERE  evento= '{$id_evento}' AND preguntas.respuesta IS NOT NULL AND preguntas.usuario= '{$id_usuario}';";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($fila as $campo)  {   
?>
            <table bordercolor= "red" border="2" >
                <thead>
                    <tr>
                        <th>
<label for="texto" ><?php echo "Usuario: ".usuario('email',$_SESSION['email']); ?></label><br>		
<textarea rows="0" cols="50" readonly="readonly"> <?php echo pregunta('texto',$campo); ?></textarea>   
<textarea rows="5" cols="90" readonly="readonly"> <?php echo pregunta('respuesta',$campo); ?></textarea>   
                        </th>
                    </tr>
                </thead>
                
            </table>

<br>
<br>
<?php



}
        
    }
                    }

function otras_respuesta($mostrar,$id_evento)  {

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";
    $id_usuario=usuario('id_usuario',$_SESSION['email']);
    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql="select $mostrar from preguntas WHERE  evento= '{$id_evento}' AND preguntas.respuesta IS NOT NULL AND preguntas.usuario!= '{$id_usuario}';";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($fila as $campo)  {   
            
            ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>
<?php
$otro=pregunta('usuario',$campo);
 
?>
<label for="texto" ><?php echo "Usuario: ".otro_usuario('email',$otro); ?></label><br>		
<textarea rows="0" cols="50" readonly="readonly"> <?php echo pregunta('texto',$campo); ?></textarea>   
<textarea rows="5" cols="90" readonly="readonly"> <?php echo pregunta('respuesta',$campo); ?></textarea>   

                        </th>
                    </tr>
                </thead>
            </table>

<br>
<br>
<?php



}
        
    }
                    }


function mostrar($mostrar)  {

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql="select $mostrar from preguntas WHERE evento = '{$_SESSION['email']}';";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($fila as $campo)  {   
return $campo;
            }
        
    }
                    }
                    ?>

  
 
<div class="container">
            <div class="text-center row">

                <h1>
                </h1>
                    <!--Espacio-->
                    
                    
<form action="verificacionpreguntas.php" method="post" enctype="multipart/form-data">
             		
      <textarea name="pregunta" rows="5" cols="5" class="form-control" placeholder="Hacer pregunta..." required></textarea>   
      <input type="hidden" name="a_donde" value="<?php echo $a_donde ?>">
      <input type="hidden" name="id" value="<?php echo $pasar_id_evento ?>">
                <button type="submit" class="btn btn-primary" >Preguntar</button>
                      </form>
                    <br><br>
                    <?php
 echo "Preguntas Respondidas: <br><br>  ";
  
 
 mis_respuesta('id_pregunta',$pasar_id_evento);
 otras_respuesta('id_pregunta',$pasar_id_evento);     
                    
                    
                       
?>

                
                    <br>

                    <br>
                    <br>
                    <br>

                
            </div>
        </div>


</html>
