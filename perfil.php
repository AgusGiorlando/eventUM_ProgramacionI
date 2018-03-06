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
echo $campo;
            }
        
    }
                    }
                    ?>
<?php
function mostrarimagen(){
$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";

$conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
$sql="select foto from usuarios WHERE email = '{$_SESSION['email']}';";
$resultado=$conn->query($sql);
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
       
             
?>         
     <img height="200px" src="data:imagen/jpg;base64,<?php echo base64_encode($fila['foto']) ?>"/>
     
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
                
            </div>
            
        </div>
    </nav>
    <header>
        
        
    
   <div class="container">
            <div class="text-center row">
                 
 <h2> Perfil </h2>
                <form action="modificar.php" method="post" name="nvaClave">
                    Nombre: <input type="text" name="nombre" value= '<?php mostrar("nombre"); ?>' class="form-control" placeholder="Ingresa tu nombre" required>
		<div style="height: 10px;"></div>                   
		Apellido: <input type="text" name="apellido" value= '<?php mostrar("apellido"); ?>' class="form-control" placeholder="Ingresa tu apellido" required>
		<div style="height: 10px;"></div>		
		E-mail: <input type="text" name="email" value= '<?php mostrar("email"); ?>' class="form-control" placeholder="Ingresa tu E-imail" required>
		<div style="height: 10px;"></div>		
		Fecha de Nacimiento: <input type="date" name="fecha" value= '<?php mostrar("fecha_nacimiento"); ?>' class="form-control" placeholder="Ingresa tu fecha de nacimiento" required>
		<div style="height: 10px;"></div>		
                Contraseña: <input type="password" name="contraseña" value= '<?php mostrar("contrase�a"); ?>' class="form-control" placeholder="Ingresa tu contraseña" required>
		<div style="height: 10px;"></div>		
		Confirmar contraseña: <input type="password" name="c_contraseña" value= '<?php mostrar("contrase�a"); ?>' class="form-control" placeholder="Confirmacion contraseña" required> 
		<div style="height: 10px;"></div>
		Curriculum: <textarea name="curriculum" rows="10" cols="40" value= '<?php mostrar("curriculum"); ?>' class="form-control" placeholder="Ingresar datos del Curriculum" required></textarea>
                <div style="height: 10px;"></div>
                <button type="submit" class="btn btn-primary" onClick="comprobarClave()">Modificar</button>
                
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

	