<?php

$emailFrom = "";
$firstName = "";
$LastName = "";
$message = "";


$emailFrom = $_POST["emailContact"];
$firstName = $_POST["firstNameContact"];
$LastName = $_POST["lastNameContact"];
$message = $_POST["messageContact"];
$fullName = $firstName . ' ' . $LastName;

require 'PHPMailerAutoload.php';
$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'noreply.teamgao@gmail.com';                 // SMTP username
$mail->Password = 'P@ssw0rdtoor';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('noreply.teamgao@gmail.com', 'NoReply-TeamGao');
$mail->addAddress('gao_yujing@columbusstate.edu', 'Yujing Gao');     // Add a recipient
//$mail->addAddress('corbin_caleb@columbusstate.edu', 'Corbin Caleb'); 
//$mail->addAddress('holmes_dustin@columbusstate.edu', 'Dustin Holmes'); 
//$mail->addAddress('stadtmueller_johnathan@columbusstate.edu', 'Jonathan Stadmueller'); 
$mail->addReplyTo($_POST['email'], $_POST['name']);

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Feedback from Team Gao';
$mail->Body    = $fullName . ' has sent you a feeback on website.<br><br><b>Name: </b>' . $fullName . '<br><b>Contact Email: </b>' . $emailFrom . '<br><b>Message: </b>' . $message;
$mail->AltBody = $fullName . ' has sent you a feeback on website.\nName: ' . $fullName . '\nContact Email: ' . $emailFrom . '\nMessage: ' . $message;

echo '<script language="javascript">';
if (!$mail->send()) {
    echo 'alert("Message could not be sent.")';
} else {
    echo ('alert("Thank you ' . $firstName . '. Your message has been sent to our team.")');
}
echo '</script>';
header('Location: https://web-project-team-gao.herokuapp.com//?page=contact');
