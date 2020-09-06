<?php
   require("../vendor/autoload.php");
   require("include/classes.php");
  $format=new format();
  $main=new main();
  $domain= $format->getdomain();
  $main_cls=new main();
$query = $main_cls->select("select * from settings");
$settings = $query->fetch_assoc();
$more = json_decode($settings['more']);
$referer = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER']) : '';
$chost=$_SERVER["HTTP_HOST"];
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;
    $mail = new PHPMailer(true);
if( $_POST["send_mail"]==true and $referer["host"] === $chost){
    $to=$_REQUEST["to"];
    $subject="Admin reply- ".$_REQUEST["sub"];
    $body=$_REQUEST["body"];
    $redirect=$_REQUEST["redirect"];
     try {
         //Server settings
         //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
         $mail->isSMTP();                                            // Send using SMTP
         $mail->Host       = $more->host;                    // Set the SMTP server to send through
         $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
         $mail->Username   = $more->username;                     // SMTP username
         $mail->Password   = $more->password;                               // SMTP password
         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
         $mail->Port       = $more->port;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
         //Recipients
         $mail->setFrom($more->username,$domain);
         $mail->addAddress($to);     // Add a recipient
         //$mail->addAddress('ellen@example.com');               // Name is optional
         $mail->addReplyTo($more->username, $chost);
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
         header("location: $redirect?status=true");
        exit;
     } catch (Exception $e) {
        header("location: $redirect?status=false");
        exit;
     }
    }else{
        echo '
        <script type="text/javascript">
        window.location = "http://'.$referer["host"].'?check=false";
    </script>';
        exit;
    }