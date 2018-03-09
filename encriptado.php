<?php
$clave = "clave";
function encriptar_AES($string, $key){
    $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, ''); // Nuevo modulo de cifrado
    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_DEV_URANDOM ); //Creacion del vector de inicializacion
    mcrypt_generic_init($td, $key, $iv); // Inicializacion de buffers necesarios para cifrado
    $encrypted_data_bin = mcrypt_generic($td, $string); //Cifrado
    mcrypt_generic_deinit($td); //Liberacion de buffers reservados
    mcrypt_module_close($td);   //Cierre de los recursos
    $encrypted_data_hex = bin2hex($iv).bin2hex($encrypted_data_bin);
return $encrypted_data_hex;
 }

 function desencriptar_AES($encrypted_data_hex, $key){
    $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
    $iv_size_hex = mcrypt_enc_get_iv_size($td)*2;
    $iv = pack("H*", substr($encrypted_data_hex, 0, $iv_size_hex));
    $encrypted_data_bin = pack("H*", substr($encrypted_data_hex, $iv_size_hex));
    mcrypt_generic_init($td, $key, $iv);
    $decrypted = mdecrypt_generic($td, $encrypted_data_bin);
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);
return $decrypted;
 }

?>