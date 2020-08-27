<?php
require_once("vendor/autoload.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 $mail = new PHPMailer(true);
 try {
     //Server settings
     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
     $mail->isSMTP();                                            // Send using SMTP
     $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
     $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
     $mail->Username   = 'webdevelopersharif@gmail.com';                     // SMTP username
     $mail->Password   = 'sharif470033';                               // SMTP password
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
     $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

     //Recipients
     $mail->setFrom("developersharif@gmail.com", 'from sharif');
     $mail->addAddress("developersharif@yahoo.com", 'sharif');     // Add a recipient
     //$mail->addAddress('ellen@example.com');               // Name is optional
     $mail->addReplyTo("developersharif@yahoo.com", 'reply');
    // $mail->addCC('cc@example.com');
     //$mail->addBCC('bcc@example.com');
 
     // Attachments
     //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
     //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
 
     // Content
     $mail->isHTML(true);                                  // Set email format to HTML
     $mail->Subject =  "this is subject";
     $mail->Body    = "<h2>developersharif</h2>";
     $mail->AltBody = $body;
     $mail->send();
     echo "Successfull...";
 } catch (Exception $e) {
     return false;
 }