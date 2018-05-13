<?php
session_start();

function usuario($mostrar,$id)  {

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql="select $mostrar from usuarios WHERE id_usuario = '{$id}' ;";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($fila as $campo)  {   
return $campo;
            }
        
    }
                    }



function mensaje($mostrar,$id)  {

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql="select $mostrar from preguntas WHERE id_pregunta = '{$id}';";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($fila as $campo)  {   
return $campo;
            }
        
    }
                    }

function mostrar($mostrar,$id,$a_donde)  {

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql="select $mostrar from preguntas WHERE evento = '{$id}'  AND preguntas.respuesta IS NULL;";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($fila as $campo)  {   
   
    
?>
<p></p>

    <?php 

      
    $id=mensaje('usuario',$campo);
    
    echo 'Usuario:  '. Usuario('email',$id); ?>   
<form action="verificacionrespuesta.php" method="post" enctype="multipart/form-data">
<?php 

// 
?>
    
<textarea rows="0" cols="60"> <?php echo mensaje('texto',$campo); ?></textarea>
<textarea name="pregunta" rows="0" cols="80" class="form" placeholder="<?php echo mensaje('respuesta',$campo); ?>" ></textarea>
<input type="hidden" name="a_donde" value="<?php echo $a_donde ?>">

<input type="hidden" name="id" value="<?php echo $campo ?>">
             
<button type="submit" class="btn btn-primary" >Responder</button>
                
</form>

<?php
echo "<br>"; 
            
  
}
        
    }
                    }
                    ?>

<!DOCTYPE html>
<html >
  

<head>
    
    
    

    </head>

    
        
        
    
   <div class="container">
            <div class="text-center row">

                <h1>
                </h1>
                <p>
                    <!--Espacio-->
                
            <?php mostrar('id_pregunta',$pasar_id_evento,$a_donde); ?>   		
                <!--<textarea name="pregunta" rows="5" cols="5" class="form-control" placeholder="Hacer pregunta..." required></textarea>   
                <button type="submit" class="btn btn-primary" >Preguntar</button>-->
                


                    <br>

                    <br>
                    <br>
                    <br>

                </p>
            </div>
        </div>
  