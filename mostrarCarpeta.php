<?php 
    $dir = opendir(getcwd()."\docs/1");   // Indica el patch de la carpeta donde esten los archivos
    while ($file = readdir($dir)) {
        if ( preg_match("(doc|pdf)",$file) ) {  // Ficheros a mostrar
            $e1 = "$file";
            $se = explode('.',$e1);  // Para que no me muestre la extension del archivo
            echo "<strong>&raquo;</strong>  <a href=docs/"."$file>".$se[0].".".$se[1]."</a><br>";
        }
    }
    closedir($dir);
?>

<div id="galeria" class="galeria">
<h2>Galería de imágenes</h2>
<?php
	$NAMEFILE = "galeria.php";
	$dir = opendir("docs/1/");
	while ($file = readdir($dir)) {
        if ( preg_match("(png|jpg)",$file) ) {  // Ficheros a mostrar
            if ($file != "." && $file != ".." && $file != "$NAMEFILE") {
	            $data[$file]='<div class="grid_3 imagen"><a href="docs/1/'.$file.'" target="_blank"><img src="docs/1/'.$file.'" alt="'.$file.'" title="'.$file.'" width="90%" height="90%" /></a></div>';
            }
        }
    }

	rsort($data);
	while(list($k,$v) = each($data)) { echo $v; }
	clearstatcache();
	echo "<br />";
?>
</div>	

