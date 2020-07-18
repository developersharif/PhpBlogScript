<?php
if (isset($_POST['submit']) and isset($_POST['mail_to']) and isset($_POST['mail_sub']) and isset($_POST['mail_body'])) {
    $to = $_POST['mail_to'];
    $subject = $_POST['mail_sub'];
    $body = $_POST['mail_body'];
    $from = $_POST['mail_from'];
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: ' . $from . "\r\n";
    //$headers .= 'Cc: myboss@example.com' . "\r\n";
    $send = mail($to, $subject, $body, $headers);
    if ($send) {
        return true;
    } else {
        return false;
    }
}
