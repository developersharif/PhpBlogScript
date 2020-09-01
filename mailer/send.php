<?php
   require("../configer/config.php");
   require("../vendor/autoload.php");
   require("../classes/main_cls.php");
   require("../classes/format.php");
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
     ?>
     <?php 
     $html_body = '
     <!doctype html>
     <html>
       <head>
         <meta name="viewport" content="width=device-width" />
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
         <title>Simple Transactional Email</title>
         <style>
     img{border:none;-ms-interpolation-mode:bicubic;max-width:100%}body{background-color:#f6f6f6;font-family:sans-serif;-webkit-font-smoothing:antialiased;font-size:14px;line-height:1.4;margin:0;padding:0;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}table{border-collapse:separate;mso-table-lspace:0;mso-table-rspace:0;width:100%}table td{font-family:sans-serif;font-size:14px;vertical-align:top}.body{background-color:#f6f6f6;width:100%}.container{display:block;margin:0 auto!important;max-width:580px;padding:10px;width:580px}.content{box-sizing:border-box;display:block;margin:0 auto;max-width:580px;padding:10px}.main{background:#fff;border-radius:3px;width:100%}.wrapper{box-sizing:border-box;padding:20px}.content-block{padding-bottom:10px;padding-top:10px}.footer{clear:both;margin-top:10px;text-align:center;width:100%}.footer a,.footer p,.footer span,.footer td{color:#999;font-size:12px;text-align:center}h1,h2,h3,h4{color:#000;font-family:sans-serif;font-weight:400;line-height:1.4;margin:0;margin-bottom:30px}h1{font-size:35px;font-weight:300;text-align:center;text-transform:capitalize}ol,p,ul{font-family:sans-serif;font-size:14px;font-weight:400;margin:0;margin-bottom:15px}ol li,p li,ul li{list-style-position:inside;margin-left:5px}a{color:#3498db;text-decoration:underline}.btn{box-sizing:border-box;width:100%}.btn>tbody>tr>td{padding-bottom:15px}.btn table{width:auto}.btn table td{background-color:#fff;border-radius:5px;text-align:center}.btn a{background-color:#fff;border:solid 1px #3498db;border-radius:5px;box-sizing:border-box;color:#3498db;cursor:pointer;display:inline-block;font-size:14px;font-weight:700;margin:0;padding:12px 25px;text-decoration:none;text-transform:capitalize}.btn-primary table td{background-color:#3498db}.btn-primary a{background-color:#3498db;border-color:#3498db;color:#fff}.last{margin-bottom:0}.first{margin-top:0}.align-center{text-align:center}.align-right{text-align:right}.align-left{text-align:left}.clear{clear:both}.mt0{margin-top:0}.mb0{margin-bottom:0}.preheader{color:transparent;display:none;height:0;max-height:0;max-width:0;opacity:0;overflow:hidden;mso-hide:all;visibility:hidden;width:0}.powered-by a{text-decoration:none}hr{border:0;border-bottom:1px solid #f6f6f6;margin:20px 0}@media only screen and (max-width:620px){table[class=body] h1{font-size:28px!important;margin-bottom:10px!important}table[class=body] a,table[class=body] ol,table[class=body] p,table[class=body] span,table[class=body] td,table[class=body] ul{font-size:16px!important}table[class=body] .article,table[class=body] .wrapper{padding:10px!important}table[class=body] .content{padding:0!important}table[class=body] .container{padding:0!important;width:100%!important}table[class=body] .main{border-left-width:0!important;border-radius:0!important;border-right-width:0!important}table[class=body] .btn table{width:100%!important}table[class=body] .btn a{width:100%!important}table[class=body] .img-responsive{height:auto!important;max-width:100%!important;width:auto!important}}@media all{.ExternalClass{width:100%}.ExternalClass,.ExternalClass div,.ExternalClass font,.ExternalClass p,.ExternalClass span,.ExternalClass td{line-height:100%}.apple-link a{color:inherit!important;font-family:inherit!important;font-size:inherit!important;font-weight:inherit!important;line-height:inherit!important;text-decoration:none!important}#MessageViewBody a{color:inherit;text-decoration:none;font-size:inherit;font-family:inherit;font-weight:inherit;line-height:inherit}.btn-primary table td:hover{background-color:#34495e!important}.btn-primary a:hover{background-color:#34495e!important;border-color:#34495e!important}}
         </style>
       </head>
       <body class=""> <span class="preheader">This is preheader text. Some clients will show this text as a preview.</span><table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body"><tr><td>&nbsp;</td><td class="container"><div class="content"><table role="presentation" class="main"><tr><td class="wrapper"><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td><p>Reset your password? If you requested a password reset for your account, click the button below. If you did not make this request, ignore this email.</p><table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary"><tbody><tr><td align="left"><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tbody><tr><td> <a href="http://'. $_REQUEST["body"].'" target="_blank">Reset password</a></td></tr></tbody></table></td></tr></tbody></table><p>Good luck! Hope it works.</p></td></tr></table></td></tr></table><div class="footer"><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="content-block"> <br> do not like these emails? <a href="http://developersharif/unsbscribe">Unsubscribe</a>.</td></tr><tr><td class="content-block powered-by"> Powered by <a href="http://google.com/search?q=developersharif">-Php blog-</a>.</td></tr></table></div></div></td><td>&nbsp;</td></tr></table></body>
     </html>
      ' ; ?>
     <?php 
if( $_REQUEST["send_mail"]==true and $referer["host"] === $chost){
    $to=$_REQUEST["to"];
    $subject=$_REQUEST["sub"];
    $body=$_REQUEST["body"];
    $redirect=$_REQUEST["redirect"];
     try {
         //Server settings
         $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
         $mail->isSMTP();                                            // Send using SMTP
         $mail->Host       = $more->host;                    // Set the SMTP server to send through
         $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
         $mail->Username   = $more->username;                     // SMTP username
         $mail->Password   = $more->password;                               // SMTP password
         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
         $mail->Port       = $more->port;                                   // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
         //Recipients
         $mail->setFrom("developersharif@gmail.com",$domain);
         $mail->addAddress($to);     // Add a recipient
         //$mail->addAddress('ellen@example.com');               // Name is optional
         $mail->addReplyTo("developersharif@yahoo.com", $chost);
        // $mail->addCC('cc@example.com');
         //$mail->addBCC('bcc@example.com');
     
         // Attachments
         //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
         //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
     
         // Content
         $mail->isHTML(true);                                  // Set email format to HTML
         $mail->Subject =  $subject;
         $mail->Body    =  $html_body;
         $mail->AltBody =  $html_body;
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