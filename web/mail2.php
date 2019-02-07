<?php 


	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'libraries/phpmailer/src/Exception.php';
	require 'libraries/phpmailer/src/PHPMailer.php';
	require 'libraries/phpmailer/src/SMTP.php';


	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try {
	    //Server settings
	    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
	    $mail->isSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = 'smtp.gmail.com';						  // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = 'fcaffield2@gmail.com';                 // SMTP username
	    $mail->Password = 'steffy26284';                           // SMTP password
	    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	    $mail->Port = 587;                                    // TCP port to connect to

	    //Recipients
	    $mail->setFrom('fcaffield2@gmail.com', 'Mailer');
	    $mail->addAddress('fectous@gmail.com', 'Frank Test');     // Add a recipient
	    // $mail->addAddress('ellen@example.com');               // Name is optional
	    $mail->addReplyTo('fcaffield2@gmail.com', 'Information');
	    // $mail->addCC('cc@example.com');
	    // $mail->addBCC('bcc@example.com');

	    //Attachments
	    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	    //Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Here is the subject';
	    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
	    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	    $mail->send();
	    echo 'Message has been sent';
	} catch (Exception $e) {
	    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}


?>