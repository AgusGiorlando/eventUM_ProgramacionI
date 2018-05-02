<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verificacion</title>
</head>
<body>
    <?php
    //VERIFICACION DE USUARIO
    $servidor = "localhost";
    $bd = "eventum";
    
    $conexion = new PDO("mysql:host=$servidor;port=3306;dbname=$bd;charset=utf8","root","");
    
    $sql = "SELECT * FROM usuarios WHERE email = '" . $_POST['email'] . "' ;";
    $ejecucion = $conexion->prepare($sql);
    $ejecucion->execute();

    $usuario = $ejecucion->fetchAll(PDO::FETCH_ASSOC);

    if(isset($usuario[0])){
        //GENERACION DE LINK
        require 'encriptado.php';
        
        $link = "http://localhost/programacionI/EventUM_ProgramacionI/formularioClave.php?a=". encriptar_AES($usuario[0]['id_usuario'],$clave);
        //EMAIL
        
error_reporting(E_STRICT);
require_once('class.phpmailer.php');
include('class.smtp.php');
	
	$mail = new PHPMailer();
    $mail->SMTPSecure = 'tls';
    $mail->Username = "proyecto2018_programacion@hotmail.com";
    $mail->Password = "Proyecto2018";
    $mail->AddAddress($_POST['email']);
    $mail->FromName = "Correo gmail";
    $mail->Subject = "Registro";
    $mail->Body = $link;
    $mail->Host = "smtp.live.com";
    $mail->Port = 587;
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->From = $mail->Username;
    $mail->Send();

include('mensajeVerificarmail.php');
    }else{
        echo "No se encontro la direccion de email";
    }
    ?>    
</body>
</html>
