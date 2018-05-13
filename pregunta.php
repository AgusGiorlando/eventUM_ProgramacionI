<?php
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
function respuesta($mostrar,$id_evento)  {

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql="select $mostrar from preguntas WHERE  evento= '{$id_evento}' AND preguntas.respuesta IS NOT NULL;";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($fila as $campo)  {   
?>
<textarea rows="0" cols="50" > <?php echo pregunta('texto',$campo); ?></textarea>   
<textarea rows="5" cols="90" > <?php echo pregunta('respuesta',$campo); ?></textarea>   
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
    <br><br><br>
             		
      <textarea name="pregunta" rows="5" cols="5" class="form-control" placeholder="Hacer pregunta..." required></textarea>   
      <input type="hidden" name="a_donde" value="<?php echo $a_donde ?>">
      <input type="hidden" name="id" value="<?php echo $pasar_id_evento ?>">
                <button type="submit" class="btn btn-primary" >Preguntar</button>
                      </form>
                    <br><br>
                    <?php
 echo "Preguntas Respondistas: <br><br>  ";
  
 
 respuesta('id_pregunta',$pasar_id_evento);
      
                    
                    
                       
?>

                
                    <br>

                    <br>
                    <br>
                    <br>

                
            </div>
        </div>


</html>
