<?php require("include/header.php");
require("classes/reset_pass.php");
$main = new main();
$user = new user();
$c_auth = $_COOKIE['c_user'];
if ($user->check_usr() == false) {
    header("location: login");
}
$reset_obj = new reset_pass();
if (isset($_POST['submit']) and !empty($_POST['oldpass']) and !empty($_POST['pass']) and !empty($_POST['cpass'])) {
    $oldpass = $_POST['oldpass'];
    $pass1 = $_POST['pass'];
    $pass2 = $_POST['cpass'];
    $email = $user->query("email");
    $db_pass = $user->query("pass");
    $uid = $user->id();
    if (password_verify($oldpass, $db_pass)) {
        if ($pass1 === $pass2) {
            if (strlen($pass2) > 5) {
                $auth = md5(sha1($email . $pass2));
                $hash_pass = password_hash($pass2, PASSWORD_DEFAULT);
                $update = $main->update("update users set pass='$hash_pass',auth='$auth' where id='$uid'");
                if ($update) {
                    $cookie_name = 'c_user';
                    $cookie_value = $auth;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 10), "/"); // 86400 = 1 day
                    header("location:changepass?done");
                } else {
                    $info_msg = "Failed";
                }
            } else {
                $info_msg = "password too short";
            }
        } else {
            $info_msg = "Password did not matched!";
        }
    } else {
        $info_msg = "your current password is wrong please try again";
    }
}
?>
<bode>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php if (isset($info_msg)) { ?> <center>
                    <div class="alert alert-info">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $info_msg; ?></div>
                </center><?php } ?>
                <?php if (isset($_GET['done'])) { ?> <center>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo "Password Changed"; ?></div>
                </center><?php } ?>
                <form action="" method="post">
                    <input type="text" name="oldpass" id="oldpass" placeholder="Current password" class="form-control">
                    <input type="text" name="pass" id="pass" placeholder="New password(=>6)" class="form-control">
                    <input type="text" name="cpass" id="cpass" placeholder="Confirm Password(=>6)" class="form-control">
                    <input type="submit" value="Change password" name="submit" class="btn">
                    <br>
                </form>
            </div>
        </div>
    </div>
</bode>


<?php include("include/footer.php"); ?>