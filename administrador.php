<!DOCTYPE html>
<?php
function mostrar($table,$mostrar,$id_table,$id)  {

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
                        <a href="pagina_principal.php">Pagina Principal</a>
                    </li>

                    
                </ul>
            </div>
            
        </div>
    </nav>
    <header>
        
        
    
   <div class="container">
            <div class="text-center row">
                <p>
                <p>Usuarios Registrados</p>
                    <?php

$servidor="localhost";
$usuario="root";
$contrasena="";
$nombrebd="eventum";
    


    $conn=new PDO("mysql:host=$servidor;dbname=$nombrebd",$usuario,$contrasena);
    $sql="select id_usuario as ID,nombre as Nombre,apellido as Apellido,email as Email,fecha_nacimiento as Fecha_Nacimiento,curriculum as Curriculum,contraseña as Password from usuarios WHERE admin = '0';";
    $ejecutar=$conn->prepare($sql);
    $ejecutar->execute();
    $i=0;
    echo "<table border='1'>";
    echo "   <thead>";
    echo"<tr>";
        while ($columna = $ejecutar->getColumnmeta($i)) {

            echo"<th> ";
            echo $columna['name'];
            echo"</th>";
            $i++;
        }
        echo"<th> ";
        echo "Foto";
        echo"</th>";
        echo"<th> ";
        echo "Opciones";
        echo"</th>";
        
        echo"</tr>";
            
    echo "   </thead>";
    echo "   <tbody>";
    echo'<form action="borrador.php" method="GET" >';
    while ($fila = $ejecutar->fetch(PDO::FETCH_NUM)){
        echo '<tr>';
        for ($index = 0; $index < count($fila); $index++) {
            if ($index == 0) {
                $id = $fila[$index];
            }
            echo "<td>$fila[$index]</td>";
        }
        $foto=mostrar("usuarios","foto","id_usuario",$id);
        
        echo "<td>";
        if($foto!=NULL){
            echo "SI";
            
        }else {
            echo "NO";
            
        }
        echo "</td>";
        
        echo "<td><a href='borrador.php?id=$id'>Borrar</a> | <a href='formularioUsuario.php?id=$id'>Modificar</a></td>";
        
        echo '</tr>';
    }
    echo'</form>';
    echo "   </tbody>";
    echo "   </table>";

 ?>
 <br>
                
      <p>Eventos Registrados</p>
 <?php  
    $nulo=0;
    $sq2="select id_evento as ID,titulo as Titulo,inicio as Inicio,duracion as Duracion,descripcion as Descripcion,cupo_max as Cupo_Maximo,precio as Precio,presentador as ID_Presentador,archivo as ID_Archivo,asistente as ID_Asistente,pregunta as ID_Pregunta from eventos WHERE nulo=".$nulo;
   
    $ejecutar1=$conn->prepare($sq2);
    $ejecutar1->execute();
    $i=0;
    echo "<table border='1'>";
    echo "   <thead>";
    echo"<tr>";
        while ($columna = $ejecutar1->getColumnmeta($i)) {

            echo"<th> ";
            echo $columna['name'];
            echo"</th>";
            $i++;
        }
        echo"<th> ";
        echo "Ubicacion";
        echo"</th>";
        
        echo"<th> ";
        echo "Opciones";
        echo"</th>";
        
        echo"</tr>";
            
    echo "   </thead>";
    echo "   <tbody>";
    echo'<form action="borrador.php" method="GET" >';
    while ($fila = $ejecutar1->fetch(PDO::FETCH_NUM)){
        echo '<tr>';
        for ($index = 0; $index < count($fila); $index++) {
            if ($index == 0) {
                $id = $fila[$index];
            }
            echo "<td>$fila[$index]</td>";
        }
        $ubicacion=mostrar("eventos","ubicacion","id_evento",$id);
        
        
        echo "<td>";
        if($ubicacion!=NULL){
            echo "SI";
            
        }else {
            echo "NO";
            
        }
        echo "</td>";

        echo "<td><a href='borrador_evento.php?id=$id'>Deshabilitar</a> | <a href='formularioEvento.php?id=$id'>Modificar</a></td>";
        
        
        echo '</tr>';
    }
    echo'</form>';
    echo "   </tbody>";
    echo "   </table>";

    echo '  <br><br><p>Eventos Anulados</p>';
    
    $nulo=1;
    $sq2="select id_evento as ID,titulo as Titulo,inicio as Inicio,duracion as Duracion,descripcion as Descripcion,cupo_max as Cupo_Maximo,precio as Precio,presentador as ID_Presentador,archivo as ID_Archivo,asistente as ID_Asistente,pregunta as ID_Pregunta from eventos WHERE nulo=".$nulo;
   
    $ejecutar1=$conn->prepare($sq2);
    $ejecutar1->execute();
    $i=0;
    echo "<table border='1'>";
    echo "   <thead>";
    echo"<tr>";
        while ($columna = $ejecutar1->getColumnmeta($i)) {

            echo"<th> ";
            echo $columna['name'];
            echo"</th>";
            $i++;
        }
        echo"<th> ";
        echo "Ubicacion";
        echo"</th>";
        
        echo"<th> ";
        echo "Opciones";
        echo"</th>";
        
        echo"</tr>";
            
    echo "   </thead>";
    echo "   <tbody>";
    echo'<form action="borrador.php" method="GET" >';
    while ($fila = $ejecutar1->fetch(PDO::FETCH_NUM)){
        echo '<tr>';
        for ($index = 0; $index < count($fila); $index++) {
            if ($index == 0) {
                $id = $fila[$index];
            }
            echo "<td>$fila[$index]</td>";
        }
        $ubicacion=mostrar("eventos","ubicacion","id_evento",$id);
        
        
        echo "<td>";
        if($ubicacion!=NULL){
            echo "SI";
            
        }else {
            echo "NO";
            
        }
        echo "</td>";

        echo "<td><a href='habilitar_evento.php?id=$id'>Habiliar</a></td>";
        
        echo '</tr>';
    }
    echo'</form>';
    echo "   </tbody>";
    echo "   </table>";

    
    
 ?>                           

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
