<?php
session_start();
function mostrar1($table,$mostrar,$id_table,$id)  {

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql="select $mostrar from $table WHERE $id_table = '{$id}';";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($fila as $campo)  {   
            return $campo;
            }
        
    }
                    }


function mostrar($mostrar)  {

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql="select $mostrar from eventos WHERE id_evento = '{$_GET['id']}';";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    
    while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)) {   
      
        foreach ($fila as $campo)  {   
echo $campo;
            }
        
    }
                    }
?>
<!DOCTYPE html>

<html>
    <head>
        <title>EventUM</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
<style>
    </style>
    </head>

    <nav>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <img class="img-responsive" src="img/logo.png" >
                </div>
                <ul class="nav navbar-nav navbar-right">
                </ul>
            </div>
        </div>
    </nav>
    <header>
        <div class="container">
            <div class="text-center row">
                <h1>
                    Modificar Evento               
                </h1>
                <p>
<?php //--------------------------------------------------------------------------------------------------------------------------------------------- ?>                   
                <form action="modificarEvento_adm.php" method="post"  enctype="multipart/form-data">
                
                <label for="texto" >Titulo: </label> 		
                <input type="text" name="titulo" class="form-control" value="<?php mostrar('titulo'); ?>"> <br>
                <label for="texto" >Inicio: </label> 		
                <input type="data" name="fecha" class="control" value="<?php mostrar('inicio'); ?>">    
                <label for="texto" >Duración: </label> 		
                <input type="data" name="duracion" placeholder="Duración" value="<?php mostrar('duracion'); ?>"> <br><br>  
                <label for="texto" >Descripción: </label> 		
                <input type="text" name="descripcion" class="form-control" value="<?php mostrar('descripcion'); ?>" > <br>
                <label for="texto" >Cupo Maximo:     </label> 		
                <input type="text" name="cupo" class="control" value="<?php mostrar('cupo_max'); ?>">    
                <label for="texto" >Precio: </label> 		
                <input type="text" name="precio"  class="control" value="<?php mostrar('precio'); ?>"> <br>
                <div class="form-group"> <br>
	        <label for="texto" >Archivo: </label> 		
                <input type="file" name="archivo[]" class="form-control" multiple="" placeholder="Agregar archivos">
		<div style="height: 10px;"></div>
		</div>
<!--       <label for="texto" >Ubicacion: </label> 
        
        <?php $ubicacion=mostrar1("eventos","ubicacion","id_evento",$_GET['id']);
        
        if($ubicacion!=NULL){
        echo "SI";
            
        }else {
        
        echo "NO";
            
        }
              ?>  
                
      -->          
                <div style="height: 10px;"></div>
	                <div style="height: 10px;"></div>               
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">

                <button type="submit" class="btn btn-primary" >Actualizar</button>
                
</form>                
<?php //include 'maps.php';
//--------------------------------------------------------------------------------------------------------------------------------------------- ?>                   
                        	</p>            
            </div>
        </div>
    </header>
   <footer>
        <div class="container">
            <div class="text-center row">
                Gracias por visitar la pagina  
            </div>
        </div>
    </footer>
</html>
	
