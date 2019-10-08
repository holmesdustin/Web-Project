<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'includes/config.php';
// Load Composer's autoloader
require 'vendor/autoload.php';

$emailFrom = "";
$firstName = "";
$LastName = "";
$message = "";


$emailFrom = $_POST["email"];
$firstName = $_POST["firstName"];
$LastName = $_POST["lastName"];
$message = $_POST["message"];

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = config['email']['host'];                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = config['email']['username'];                     // SMTP username
    $mail->Password   = config['email']['password'];                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = config['email']['port'];                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($emailFrom, $firstName . ' ' . $LastName);
    $mail->addAddress('gao_yujing@columbusstate.edu', 'Yujing Gao');     // Add a recipient

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'You got a message';
    $mail->Body    = '<p>' . $message . '</p>';
    $mail->AltBody = $message;

    $mail->send();
    echo 'Thank you! Your message has been sent to our team.';
} catch (Exception $e) {
    echo "Message could not be sent.";
}
