<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    //echo $_POST['email'];

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
        
        $link = "formularioClave.php?a=". encriptar_AES($usuario[0]['id_usuario'],$clave);
        //EMAIL
        try {
            error_reporting(E_STRICT);
            require_once('class.phpmailer.php');
            include('class.smtp.php');
                $body = $link;
                $mail = new PHPMailer();
                $mail->SMTPSecure = 'tls';
                $mail->Username = "";// SMTP Usuario
                $mail->Password = "";
                $mail->AddAddress($_POST['email']);//Destinatario
                $mail->FromName = "EventUM";
                $mail->Subject = "Recuperacion de clave";
                $mail->Body = $body;
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 587;
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->From = $mail->Username;
                $mail->Send();
            echo "<br>";
            echo 'El Mensaje ha sido enviado';
        } catch (phpmailerException $e) {
            echo $e->errorMessage();//Mensaje de error si se produciera.
        }
    }else{
        echo "No se encontro la direccion de email";
    }
    ?>    
</body>
</html>
