<?php

$emailFrom = "";
$firstName = "";
$LastName = "";
$message = "";


$emailFrom = $_POST["email"];
$firstName = $_POST["firstName"];
$LastName = $_POST["lastName"];
$message = $_POST["message"];
$fullName = $firstName . ' ' . $LastName;

require 'PHPMailerAutoload.php';
require 'config.php';
$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = config('phpMailerConfig')['host'];
$mail->SMTPAuth = true;
$mail->Username = config('phpMailerConfig')['username'];
$mail->Password = config('phpMailerConfig')['password'];
$mail->SMTPSecure = config('phpMailerConfig')['smtpSecure'];
$mail->Port = config('phpMailerConfig')['port'];

$mail->setFrom(config('phpMailerConfig')['fromAddress'], config('phpMailerConfig')['fromName']);
$mail->addAddress('gao_yujing@columbusstate.edu', 'Yujing Gao');     // Add a recipient
$mail->addAddress('corbin_caleb@columbusstate.edu', 'Corbin Caleb'); 
$mail->addAddress('holmes_dustin@columbusstate.edu', 'Dustin Holmes'); 
$mail->addAddress('stadtmueller_johnathan@columbusstate.edu', 'Jonathan Stadmueller'); 
$mail->addReplyTo($_POST['email'], $_POST['name']);

$mail->isHTML(true);

$mail->Subject = 'Feedback from Team Gao';
$mail->Body    = $fullName . ' has sent you a feeback on website.<br><br><b>Name: </b>' . $fullName . '<br><b>Contact Email: </b>' . $emailFrom . '<br><b>Message: </b>' . $message;
$mail->AltBody = $fullName . ' has sent you a feeback on website.\nName: ' . $fullName . '\nContact Email: ' . $emailFrom . '\nMessage: ' . $message;

if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo ('Thank you ' . $firstName . '. Your message has been sent to our team.');
}
