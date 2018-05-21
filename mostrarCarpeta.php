
<?php 
function mostrarCarpeta($id){
    echo "<h3>Archivos</h3>";
    $dir = opendir(getcwd()."\docs/".$id);   // Indica el patch de la carpeta donde esten los archivos
    while ($file = readdir($dir)) {
        if ( preg_match("(doc|pdf|txt)",$file) ) {  // Ficheros a mostrar
            $e1 = "$file";
            $se = explode('.',$e1);  // Para que no me muestre la extension del archivo
            echo "<strong>&raquo;</strong>  <a href=docs/".$id."/"."$file>".$se[0].".".$se[1]."</a><br>";
        }
    }
    closedir($dir);
?>

<div id="galeria" class="galeria">
<h3>Galería de imágenes</h3>
<?php
	$NAMEFILE = "galeria.php";
	$dir = opendir("docs/".$id."/");
	while ($file = readdir($dir)) {
        if ( preg_match("(png|jpg)",$file) ) {  // Ficheros a mostrar
            if ($file != "." && $file != ".." && $file != "$NAMEFILE") {
                $data[$file]='<div class="grid_3 imagen"><a href="docs/'.$id.'/'.$file.'" target="_blank"><img src="docs/'.$id.'/'.$file.'" alt="'.$file.'" title="'.$file.'" width="70%" height="80%" /></a></div>';
            }
        }
    }
    if(isset($data)){
        rsort($data);
        while(list($k,$v) = each($data)) { echo $v; }
        clearstatcache();
        echo "<br />";       
    }
?>
</div>	
<?php } ?>