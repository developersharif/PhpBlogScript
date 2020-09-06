<?php
require("include/header.php");
require("classes/reset_pass.php");
$main = new main();
$user = new user();
if ($user->check_usr()) {
    header("location: index");
}
$reset_obj = new reset_pass();
if (isset($_POST['submit']) and !empty($_POST['email'])) {
    $email = $_POST['email'];
    $check = $reset_obj->reset($email);
}
if (isset($_POST['submit']) and !empty($_POST['pass']) and !empty($_POST['cpass'])) {
    $pass1 = $_POST['pass'];
    $pass2 = $_POST['cpass'];
    if ($pass1 === $pass2) {
        $token = $_GET['token'];
        $pass = $_POST['cpass'];
        $email_q = $main->db_query("users", "auth", $token);
        $email = $email_q['email'];
        $auth = md5(sha1($email . $pass));
        $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
        $update = $main->update("update users set pass='$hash_pass',auth='$auth' where email='$email'");
        if ($update) {
            $cookie_name = 'c_user';
            $cookie_value = $auth;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 10), "/"); // 86400 = 1 day
            header("location:profile?done");
        } else {
            echo "Failed";
        }
    } else {
        echo  "<center><b style='color:red;'>Password did not matched!</b></center>";
    }
}
?>

<title>Reset Password</title>
</head>

<body>
    <?php if (!isset($_GET['token'])) : ?>
    <div class="container">
        <div class="row">
            <?php     if ( $_GET['check']==='true') {
        $info_msg = "Please check your email to reset your password!";
    } if (isset($info_msg) &  $_GET['check']==='true' ) { ?> <center>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $info_msg; ?></div>
            </center><?php }elseif($_GET['check']==='false'){ ?>

                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     Something went wrong!</div>

            <?php } ?>
            <div class="col-12">
                <h4>Password Reset.</h4>
                <form action="mailer/send.php" method="post">
                    <input type="email" name="email" placeholder="Enter your email" class="form-control"
                        style="color:black" require></input>
                    <input type="submit" class="btn" value="Submit" name="submit">
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (isset($_GET['token']) and $_GET['token'] != '') :
        $token = $_GET['token'];
        $check = $reset_obj->check_token($token);
        if ($check == true) :
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="" method="post">
                    <div id="info"></div>
                    <input type="text" name="pass" placeholder="New Password" id="password"
                        class="form-control password" style="color:black" required></input>
                    <input type="text" name="cpass" placeholder="Confirm Password" id="cpassword" class="form-control "
                        style="color:black" required></input>
                    <div class="info"></div>
                    <input type="submit" class="btn" value="Submit" name="submit" disabled>
                </form>
            </div>
        </div>
    </div>
    <?php endif;
    endif; ?>
    <br>
    <script>
    $(document).ready(function() {
        $("#password").keypress(function() {
            var pass1 = $("#password").val();
            var pass2 = $("#cpassword").val();
            if (pass1.length < 5) {
                $("#info").html('<b style="color:red">Password at least 6-32 letter</b>');
            } else {
                $("#info").html('');
            }
        });
        $("#cpassword").keyup(function() {
            var pass1 = $("#password").val();
            var pass2 = $("#cpassword").val();
            if (pass1 == pass2) {
                $(".info").html('<p style="color:green">matched</p>');
                $(':input[type="submit"]').attr('disabled', false);
            } else if (pass1 != pass2) {
                $(".info").html('<b style="color:red">Not matched</b>');
                $(':input[type="submit"]').attr('disabled', true);
            }
        });

    });
    </script>
    <?php include("include/footer.php"); ?>
</body>

</html>