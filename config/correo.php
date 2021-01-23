<?php
// Load Composer's autoloader
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';



$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.links.pe';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = 'zorem@links.pe';
$mail->Password = 'Fenix123!';
$mail->addReplyTo('elmanhpt@gmail.com', 'Zorem');
$mail->setFrom('elmanhpt@gmail.com', 'Zorem');
$mail->addAddress('zorem@links.pe', 'XZOREX');
$mail->Subject = 'TestinG eMAIL';
$mail->Body = 'This is a plain text message body';
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'The email message was sent.';
}