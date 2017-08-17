<?php
require 'bd_conexion.php';
require 'class_content.php';


session_start();

$usuario = mysql_real_escape_string($_POST["usuario"]);
$nombre = mysql_real_escape_string($_POST["nombre"]);
$apellidos = mysql_real_escape_string($_POST["apellidos"]);
$telefono = mysql_real_escape_string($_POST["telefono"]);
$email = mysql_real_escape_string($_POST["email"]);
$direccion = mysql_real_escape_string($_POST["direccion"]);
$id = mysql_real_escape_string($_POST["id"]);
$tarjeta = mysql_real_escape_string($_POST["tarjeta"]);


$f_en = $_SESSION["fechaEntrada"];
$f_sa = $_SESSION["fechaSalida"];
$ad = $_SESSION["adultos"];
$ni = $_SESSION["ninios"];



$select_id = 'SELECT usuario FROM Cliente WHERE identificacion="' . $id. '"';
    $result_id = mysql_query($select_id, $conexion);

$select = 'SELECT * FROM Reserva';
    $result = mysql_query($select, $conexion);
$num_reserva = mysql_num_rows ($result);

if(mysql_num_rows ($result_id) == 0){

     $insert = "INSERT INTO Cliente (nombre, apellidos, identificacion, email, numeroTlf, hotel, direccion) VALUES ('". $nombre . "','" . $apellidos . "','" .  $id ."' ,'". $email . "','" . $telefono . "', 'HOTEL PLAZA NUEVA', '" . $direccion . "')";
     $result = mysql_query($insert, $conexion);

}

$insert = 'INSERT INTO Reserva (identificador, fechaSalida, fechaEntrada, numTarjeta, estado, fecha, identificacion, ninios, adultos) VALUES ("'. strval($num_reserva + 1). '","' . $f_sa . '","' .  $f_en . '","' . $tarjeta . '","SinConfirmar","' . date('Y-m-d') . '","' . $id . '","' . $ni . '","' . $ad . '")';
 $result = mysql_query($insert, $conexion);


 $act = $_SESSION["actividades"];

 foreach ($act as $key => $value) {
    $insert = "INSERT INTO ReservaActividad (identificador, nombreActividad, cantidad) VALUES ('". strval($num_reserva + 1). "','" . $value->getNombre() . "','" .  $value->getNum() ."')";
    $result = mysql_query($insert, $conexion);
 }

 $hab = $_SESSION["habitaciones"];

 foreach ($hab as $key => $value) {
    $insert = "INSERT INTO ReservaHabitacion (identificador,tipo) VALUES ('". strval($num_reserva + 1). "','" . $value->getTitle() . "')";
    $result = mysql_query($insert, $conexion);
 }

//Generar factura pdf

$select = 'SELECT * FROM Hotel';
$result = mysql_query($select, $conexion);
$f = mysql_fetch_assoc ($result);

ob_start();
require './fpdf/fpdf.php';
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);


$textoHotel= "Datos del hotel\n" . $f["hotel"]."\nDireccion: ".$f["direccion"]."\nNIF: ".$f["NIF"]."\nCorreo: ".$f["correo"]."\nTelefono: ".$f["numeroTel"];
$pdf->SetXY(15, 20);
$pdf->MultiCell(90,10,utf8_decode($textoHotel),1,"L");


$textoCliente= "Datos del cliente\nNombre: ". $nombre."\nApellidos: ".$apellidos."\nDireccion: ".$direccion."\nNIF/Pasaporte: ".$id."\nCorreo: ".$email."\nTelefono: ".$telefono;
$pdf->SetXY(105, 20);
$pdf->MultiCell(90,10,utf8_decode($textoCliente),1,"L");

$texto2="Factura número: ".strval($num_reserva + 1)." de fecha: ".date('Y-m-d');
$pdf->SetXY(15, 100);
$pdf->Cell(180,10,utf8_decode($texto2),1,0,"C");

$texto3="Datos reserva\nFecha de entrada: ".$f_en."   Fecha de salida: ".$f_sa." \nNº adultos: ".strval($ad)."   Nº niños: ".strval($ni);
$pdf->SetXY(15, 110);
$pdf->MultiCell(180,10,utf8_decode($texto3),1,"L");

$pdf->SetXY(15, 150);
$pdf->SetFillColor(255, 204, 102);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(100,10,"Articulo",1,0,"C",true);
$pdf->Cell(30,10,"Cant.",1,0,"C",true);
$pdf->Cell(20,10,utf8_decode("Precio"),1,0,"C",true);
$pdf->Cell(30,10,"Subt.",1,1,"C",true);
$total=0;


$pdf->SetTextColor(0,0,0);

foreach ($hab as $key => $value) {
    $pdf->SetX(15);
    $pdf->Cell(100,10,utf8_decode(str_replace("<br>", " ", $value->getDesc())),1,0,"L");
    $pdf->Cell(30,10,"1",1,0,"C");
    $pdf->Cell(20,10,number_format($value->getPrecio(),2),1,0,"C");
    $pdf->Cell(30,10,number_format($value->getPrecio(),2),1,1,"R");
    $total+=$value->getPrecio();
}

foreach ($act as $key => $value) {
    $pdf->SetX(15);
    $pdf->Cell(100,10,utf8_decode( $value->getNombre()),1,0,"L");
    $pdf->Cell(30,10,$value->getNum(),1,0,"C");
    $pdf->Cell(20,10,number_format($value->getPrecio(),2),1,0,"C");
    $pdf->Cell(30,10,number_format($value->getPrecio()*$value->getNum(),2),1,1,"R");
    $total+=$value->getPrecio()*$value->getNum();
}

$pdf->SetX(115);
$pdf->Cell(50,10,"Total:",1,0,"C");
$pdf->Cell(30,10,number_format($total,2)." Euros",1,1,"R");

$texto4="Todos los precios en la factura llevan aplicado el IVA del 21%.";
$pdf->SetXY(15, 270);
$pdf->Cell(180,10,utf8_decode($texto4),1,0,"C");

$file = "factura.pdf";
$attachment = $pdf->Output($file, "S");
ob_end_flush();

require 'bd_desconexion.php';
require 'class.phpmailer.php';
require 'class.smtp.php';

$mail = new PHPMailer();

$msg = 'Se ha realizado una reserva.';

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

$mail->Subject = "Factura de " . $nombre;
$mail->IsHTML(true);
$mail->MsgHTML($msg);

$mail->AddAddress($xml->to);
$mail->AddStringAttachment($attachment, $file);

if(!$mail->Send()) {
   echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    $mail->clearReplyTos();
    $mail->clearAddresses();

    $mail->AddAddress($email);
    $mail->Subject = "Su factura del Hotel Plaza Nueva";

    $msg = 'Gracias por confiar en nosotros. Aquí tiene la factura de su reserva.';
    $mail->MsgHTML($msg);

    if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        header('Location: ../index.php?page=contacto');
    }
}

unlink($file);
header('Location: ../index.php?reserva=true');


?>
