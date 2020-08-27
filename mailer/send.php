<?php
   require_once("../vendor/autoload.php");
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;
    $mail = new PHPMailer(true);
if( $_REQUEST["send_mail"]==true){
    $to=$_REQUEST["to"];
    $subject=$_REQUEST["sub"];
    $body=$_REQUEST["body"];
    $redirect=$_REQUEST["redirect"];
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
         $mail->setFrom("developersharif@gmail.com");
         $mail->addAddress($to);     // Add a recipient
         //$mail->addAddress('ellen@example.com');               // Name is optional
         $mail->addReplyTo("developersharif@yahoo.com", 'reply');
        // $mail->addCC('cc@example.com');
         //$mail->addBCC('bcc@example.com');
     
         // Attachments
         //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
         //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
     
         // Content
         $mail->isHTML(true);                                  // Set email format to HTML
         $mail->Subject =  $subject;
         $mail->Body    = $body;
         $mail->AltBody = $body;
         $mail->send();
        //header("location: $redirect?check=true");
        echo '
        <script type="text/javascript">
        window.location = "../reset-password.php?check=true";
    </script>';
        exit;
     } catch (Exception $e) {
        echo '
        <script type="text/javascript">
        window.location = "../reset-password.php?check=false";
    </script>';
        exit;
     }
    }else{
        echo '
        <script type="text/javascript">
        window.location = "../reset-password.php?check=false";
    </script>';
        exit;
    }