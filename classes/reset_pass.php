<?php
class reset_pass extends main
{
    public function reset($email)
    {
        $query = "select * from users where email='$email' and role !='banned';";
        $num_rows = parent::num_rows("select * from users where email='$email' and role !='banned';");
        if ($num_rows != 0) {
            $user_info = parent::select($query);
            $user = $user_info->fetch_assoc();
            $user_email = $user["email"];
            $token = $user["auth"];
            $site = $_SERVER['SERVER_NAME'];
            $to = $user_email;
            $subject = "Password Reset.";
            $message =  $site . '/CMS/reset-password.php?token=' . $token ;

           header("location: mailer/send.php?send_mail=true&to=$to&sub=$subject&body=$message&redirect=reset-password.php");
           exit;
        } else {
            return $num_rows;
        }
    } //end fucntion
    public function check_token($token)
    {
        $rows = parent::num_rows("select auth from users where auth='$token'");
        if ($rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function pass_check($pass, $auth)
    {
        $ihash = password_hash($pass, PASSWORD_DEFAULT);
        $hash_qury = parent::select("select * from users where pass='$ihash' and auth='$auth'");
        $row = $hash_qury->fetch_assoc();
        $hash_pass = $row['pass'];
        if (password_verify($pass, $hash_pass)) {
            return true;
        } else {
            return false;
        }
    }
}