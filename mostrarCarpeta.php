<?php 
    $dir = opendir(getcwd()."\docs");   // Indica el patch de la carpeta donde esten los archivos
    while ($file = readdir($dir)) {
        if ( preg_match("(doc|pdf)",$file) ) {  // Ficheros a mostrar
            $e1 = "$file";
            $se = explode('.',$e1);  // Para que no me muestre la extension del archivo
            echo "<strong>&raquo;</strong>  <a href=docs/"."$file>".$se[0].".".$se[1]."</a><br>";
        }
    }
    closedir($dir);
?>

