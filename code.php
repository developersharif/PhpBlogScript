<?php 
   require("configer/config.php");
   require("classes/main_cls.php");
   require("classes/format.php");
function scan(){
    $main=new main();
    $email=$_POST["email"];
     $query = "select * from users where email='$email' and role !='banned';";
     $num_rows = $main->num_rows("select * from users where email='$email' and role !='banned';");
     if ($num_rows != 0) {
         $user_info = $main->select($query);
         $settings = $main->db_query("settings","id",1);
         $site_url=json_decode($settings["site_url"]);
         $dir=$site_url->dirname;
         $user = $user_info->fetch_assoc();
         $user_email = $user["email"];
         $token = $user["auth"];
         $site = $_SERVER['SERVER_NAME'];
         $to = $user_email;
         $subject = "Password Reset.";
         $message =  $site .$dir. '/reset-password.php?token=' . $token ;

        //header("location: mailer/send.php?send_mail=true&to=$to&sub=$subject&body=$message&redirect=reset-password.php");
        $data = array("url" => "$message" ,"sub"=>"$subject","to"=>"$to");
        return $data;
     } else {
        return false;
     }
 
}

$res=scan();
var_dump($res);


 ?>