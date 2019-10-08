<?php

$emailFrom = "";
$firstName = "";
$LastName = "";
$message = "";


$emailFrom = $_POST["email"];
$firstName = $_POST["firstName"];
$LastName = $_POST["lastName"];
$message = $_POST["message"];

require 'PHPMailerAutoload.php';
$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'noreply.teamgao@gmail.com';                 // SMTP username
$mail->Password = 'P@ssw0rdtoor';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom($_POST['email'], $_POST['name']);
$mail->addAddress('gao.yujing.csu@gmail.com', 'Yujing Gao');     // Add a recipient
$mail->addReplyTo($_POST['email'], $_POST['name']);

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject: ' . $_POST['subject'];
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo ('Thank you ' . $firstName . '. Your message has been sent to our team.');
}
