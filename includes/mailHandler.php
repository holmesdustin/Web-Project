<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'includes/PHPMailer/src/Exception.php';
require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';

$emailFrom = "";
if (isset($_POST["search"])) {
    $emailFrom = $_POST["search"];
};

$mail = new PHPMailer(true);

try {
    //Recipients
    $mail->setFrom($emailFrom);
    $mail->addAddress('gao_yujing@columbusstate.edu', 'Yujing Gao');     // Add a recipient

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Thank you! Your message has been sent to our team.';
} catch (Exception $e) {
    echo "Message could not be sent.";
}
