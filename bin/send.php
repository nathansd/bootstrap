<?php
// grabs relevant sections from the $_POST
// cuts , and trims down the sections
// makes sure that there is still something there
// then asigns them to the correct varible for further proccessing


if ((isset($_POST['name'])) && (strlen(trim($_POST['name'])) > 0)) {
	$name = stripslashes(strip_tags($_POST['name']));
};
if ((isset($_POST['email'])) && (strlen(trim($_POST['email'])) > 0)) {
	$email = stripslashes(strip_tags($_POST['email']));
};
if ((isset($_POST['message'])) && (strlen(trim($_POST['message'])) > 0)) {
	$message = stripslashes(strip_tags($_POST['message']));
};

// Standard phpmailer settings
require 'class.phpmailer.php';

$mail = new PHPMailer;

$mail->IsSMTP();      		                                // Set mailer to use SMTP
$mail->SMTPAuth = true; 									// Enable SMTPauthentication
$mail->Host = 'smtp.gmail.com';  							// Specify main and backup server
$mail->Port = 465;                     
$mail->Username = '****';         							// SMTP username
$mail->Password = '****';                         			// SMTP password
$mail->SMTPSecure = 'ssl';                            		// Enable encryption, 'ssl' also accepted

$mail->From = '****';
$mail->FromName = '********';

$mail->AddAddress('******');            					// Name is optional
$mail->AddReplyTo($email, $name);
// $mail->AddCC('cc@example.com');
// $mail->AddBCC('bcc@example.com');

$mail->WordWrap = 50;                                 		// Set word wrap to 50 characters
// $mail->AddAttachment('/var/tmp/file.tar.gz');         	// Add attachments
// $mail->AddAttachment('/tmp/image.jpg', 'new.jpg');    	// Optional name
$mail->IsHTML(true);                                  		// Set email format to HTML

$mail->Subject = $name;
$mail->Body    = $message;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {

// Not really necessary as form is sent via ajax, there is no 'next page'
   // echo 'Message could not be sent.</br>';
   // echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

?>