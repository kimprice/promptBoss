<?php
	
	include("./ChromePHP.php");
	require("./PHPMailer-master/PHPMailerAutoload.php");
	
	date_default_timezone_set('Etc/UTC');
	
	//Email message variables
	$email = filter_input(INPUT_POST, "email");
	$name = filter_input(INPUT_POST, "name");
	$message = filter_input(INPUT_POST, "message");
	$sendto = "fernando@learndialogue.org";
	$subject = "Room Reservation Request";
	$sendfrom = "bookit.hciproject@gmail.com";
	$fromname = "BookIt!";
	$frompassword = "B00k1t-HCI";
	

	//Create a new PHPMailer instance
	$mail = new PHPMailer;
	
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 2;
	//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';
	
	//Set the hostname of the mail server
	$mail->Host = 'smtp.gmail.com';
	// use
	// $mail->Host = gethostbyname('smtp.gmail.com');
	// if your network does not support SMTP over IPv6
	//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
	$mail->Port = 587;
	//Set the encryption system to use - ssl (deprecated) or tls
	$mail->SMTPSecure = 'tls';
	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	
	//Username to use for SMTP authentication - use full email address for gmail
	$mail->Username = $sendfrom;
	//Password to use for SMTP authentication
	$mail->Password = $frompassword;
	
	//Set who the message is to be sent from
	$mail->setFrom($sendfrom, $fromname);
	//Set an alternative reply-to address
	$mail->addReplyTo($email, $name);
	//Set who the message is to be sent to
	$mail->addAddress($sendto);
	//Set the subject line
	$mail->Subject = $subject;
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($message);
	//Replace the plain text body with one created manually
	$mail->AltBody = $message;
	
	//Check if emal was sent successfully
	if(!$mail->send()) {
		ChromePHP::log("Message was not sent.");
		ChromePHP::log("Mailer error: " . $mail->ErrorInfo);
	} else {
		ChromePHP::log("Message has been sent.");
	}
	
	//Print mail object for debugging purposes
	ChromePHP::log($mail);
?>