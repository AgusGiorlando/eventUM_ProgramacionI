<?php

session_start();
require 'encriptado.php';
$id=desencriptar_AES($_GET['id'],$clave);

function mostrar($mostrar,$id)  {

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
echo $campo;
            }
        
    }
                    }
                    ?>
<?php
function mostrarimagen($id){
$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

$conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
$sql="select foto from usuarios WHERE id_usuario = '{$id}';";
$resultado=$conn->query($sql);
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
       
             
?>         
     <img height="100px" src="data:imagen/jpg;base64,<?php echo base64_encode($fila['foto']) ?>"/>
     
 <?php
        }
}

?>

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
                <ul class="nav navbar-nav navbar-right">
                    
                    
                </ul>
            </div>
            
        </div>
    </nav>
    <header>
        
        
    
   <div class="container">
            <div class="text-center row">
                 
 <h2> Modificar </h2>
                
               <?php mostrarimagen($id);?> 
 <form action="modificarUsuario.php" method="post" name="nvaClave" enctype="multipart/form-data">
                
                <label for="texto" >Nombre: </label> 		
                <input type="text" name="nombre" class="form-control" value="<?php mostrar("nombre",$id); ?>"> <br>
                <label for="texto" >Apellido: </label> 		
                <input type="text" name="apellido" class="form-control" value="<?php mostrar("apellido",$id); ?>"> <br>
                <label for="texto" >E-mail: </label> 		
                <input type="text" name="email" class="form-control" value="<?php mostrar("email",$id); ?>"> <br>
                <label for="texto" >Fecha de Nacimiento: </label> 		
                <input type="data" name="fecha" class="form-control" value="<?php mostrar("fecha_nacimiento",$id); ?>"> <br>
                Foto: <input type="file" name="archivo" class="form-control" placeholder="Ingresa tu Foto" >
		<div style="height: 10px;"></div>		
                
                Nueva contraseña: <input type="password" name="contraseña" class="form-control" placeholder="********************" >
		<div style="height: 10px;"></div>		
		Confirmar contraseña: <input type="password" name="c_contraseña" class="form-control" placeholder="********************" > 
		<div style="height: 10px;"></div>
		
                
                 		
                <label for="texto" >Curriculum: </label> 		
                <input type="hidden" name="id" value="<?php echo $id ?>">

                <textarea name="curriculum" rows="10" cols="40" class="form-control" placeholder="<?php mostrar("curriculum",$id); ?>" required></textarea>   
                <button type="submit" class="btn btn-primary" onClick="comprobarClave()">Actualizar</button>
                
</form>
                
                
                
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

	