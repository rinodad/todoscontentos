<?php

ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once "Mail.php";

$from = "Sandra Sender <sender@example.com>";
$to = "Ramona Recipient <info@todoscontentos.com>";
$subject = "Hi!";
$body = "Hi,\n\nHow are you?";

$host = "mail.example.com";
$username = "smtp_username";
$password = "smtp_password";

$headers = array ('From' => $from,
  'To' => $to,
  'Subject' => $subject);
$smtp = Mail::factory('smtp',
  array ('host' => $host,
    'auth' => true,
    'username' => $username,
    'password' => $password));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
  echo("<p>" . $mail->getMessage() . "</p>");
 } else {
  echo("<p>Message successfully sent!</p>");
 }
?>