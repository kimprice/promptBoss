<?php

include("./ChromePHP.php");

// $email and $message are the data that is being
// posted to this page from our html contact form
$email = $_POST["email"];
$message = $_POST["purpose"];

// When we unzipped PHPMailer, it unzipped to
// public_html/PHPMailer_5.2.0
require("./PHPMailer-master/PHPMailerAutoload.php");

$mail = new PHPMailer();

// set mailer to use SMTP
$mail->IsSMTP();

// As this email.php script lives on the same server as our email server
// we are setting the HOST to localhost
//$mail->Host = "localhost"; // specify main and backup server

$mail->SMTPAuth = true; // turn on SMTP authentication

// When sending email using PHPMailer, you need to send from a valid email address
// In this case, we setup a test email account with the following credentials:
// email: send_from_PHPMailer@jeffm.webhostinghubexample.com
// pass: password
$mail->Username = "bookit.hciproject@gmail.com"; // SMTP username
$mail->Password = "B00k1t-HCI"; // SMTP password

// $email is the user's email address the specified
// on our contact us page. We set this variable at
// the top of this page with:
// $email = $_REQUEST['email'] ;
$mail->From = $email;

// below we want to set the email address we will be sending our email to.
$mail->AddAddress("fernando@learndialogue.org", "Fernando Rodriguez");

// set word wrap to 50 characters
//$mail->WordWrap = 50;
// set email format to HTML
$mail->IsHTML(true);

$mail->Subject = "Room Reservation Request";

// $message is the user's message they typed in
// on our contact us page. We set this variable at
// the top of this page with:
// $message = $_REQUEST['message'] ;
$mail->Body = $message;
$mail->AltBody = $message;

if(!$mail->Send())
{
ChromePHP::log("Message could not be sent. <p>");
ChromePHP::log("Mailer Error: " . $mail->ErrorInfo);
exit;
}

ChromePHP::log("Message has been sent");
/**/
?>