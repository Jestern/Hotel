<?php

require 'class.phpmailer.php';
require 'class.smtp.php';

$mail = new PHPMailer();

$nombre = $_POST["nombre"];
$telefono = $_POST["telefono"];
$email = $_POST["email"];
$mensaje = $_POST["mensaje"];
$msg = '<p>Nombre: ' . $nombre . '<br>Telefono: ' . $telefono .
               '<br>E-mail: ' . $email . '<br>Mensaje:<br><br>' . $mensaje . '</p>';

if (file_exists('../config.xml')) {
    $xml = simplexml_load_file('../config.xml');
} else {
    exit('Error abriendo config.xml.');
}

$mail->CharSet = "UTF-8";
$mail->IsSMTP();
$mail->Host = $xml->server;
//$mail->SMTPDebug  = 2;

$mail->SMTPAuth = true;
$mail->SMTPSecure = $xml->security;
$mail->Host = $xml->server;
$mail->Port = $xml->port;
$mail->Username = $xml->user;
$mail->Password = $xml->pass;

$mail->SetFrom($xml->email, $xml->name);
$mail->AddReplyTo($email, $nombre);

$mail->Subject = "Formulario de contacto de " . $nombre;
$mail->IsHTML(true);
$mail->MsgHTML($msg);

$mail->AddAddress($xml->to);

if(!$mail->Send()) {
   echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    $mail->clearReplyTos();
    $mail->clearAddresses();

    $mail->AddAddress($email);

    $msg = '<p>Gracias por ponerse en contacto con nosotros.<br>
            Le responderemos lo antes posible.<br><br>
            Este mensaje se ha generado de forma automática, por favor no
            responda a este e-mail.<br><br> Copia de su mensaje:<br>' . $msg;
    $mail->MsgHTML($msg);

    if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        header('Location: ../index.php?page=contacto');
    }
}

?>
