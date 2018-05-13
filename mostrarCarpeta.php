<?php
        /**
 * Funcion que muestra la estructura de carpetas a partir de la ruta dada.
 */
mostrarCarpeta(getcwd()."\docs");
function mostrarCarpeta($ruta){
    // Se comprueba que realmente sea la ruta de un directorio
    if (is_dir($ruta)){
        // Abre un gestor de directorios para la ruta indicada
        $gestor = opendir($ruta);
        echo "<ul>";
        // Recorre todos los elementos del directorio
        while (($archivo = readdir($gestor)) !== false)  {
            $ruta_completa = $ruta . "/" . $archivo;
            // Se muestran todos los archivos y carpetas excepto "." y ".."
            if ($archivo != "." && $archivo != "..") {
                // Si es un directorio se recorre recursivamente
                    echo "<li>" . $archivo . "</li>";
                }
            }
        }       
        // Cierra el gestor de directorios
        closedir($gestor);
        echo "</ul>";
}
        ?>