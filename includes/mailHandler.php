<?php

require 'config.php';

$emailFrom = "";
$firstName = "";
$LastName = "";
$message = "";


$emailFrom = $_POST["email"];
$firstName = $_POST["firstName"];
$LastName = $_POST["lastName"];
$message = $_POST["message"];



require_once "Mail.php";

$host = "ssl://smtp.gmail.com";
$username = "noreply.teamgao@gmail.com";
$password = "P@ssw0rdtoor";
$port = "587";
$to = "gao_yujing@columbusstate.edu";
$email_from = $emailFrom;
$email_subject = "Subject Line Here: " ;
$email_body = "whatever you like" ;
$email_address = $emailFrom;

$headers = array ('From' => $email_from, 'To' => $to, 'Subject' => $email_subject, 'Reply-To' => $email_address);
$smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
$mail = $smtp->send($to, $headers, $email_body);


if (PEAR::isError($mail)) {
echo("<p>" . $mail->getMessage() . "</p>");
} else {
echo("<p>Message successfully sent!</p>");
}
?>