<?php
require_once("../../configer/config.php");
require_once("../../classes/main_cls.php");
require_once("../../classes/validation.php");
$main = new main();
$validatin = new validation();
$check_admin = $main->num_rows("select * from users where role='global admin'");
if ($main->db_check() == false) {
    header("location: ../../index.php");
    exit();
} elseif ($check_admin != false) {
    header("location: ../../index.php");
    exit();
}
if (isset($_GET["admin"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" & isset($_POST["submit"]) & !empty($_POST["name"]) & !empty($_POST["cemail"]) & !empty($_POST["cpass"]) & isset($_GET["admin"])) {
        $name = $validatin->validate($_POST["name"]);
        $email = $validatin->validate($_POST["email"]);
        $pass = htmlspecialchars($_POST["pass"]);
        $conpass = htmlspecialchars($_POST["cpass"]);
        $check = $main->select("select * from users where email='$email';");
        $checkmail = mysqli_num_rows($check);
        if ($checkmail == 0) {
            //validation
            if (strlen($name) > 25  or empty($name)) {
                $info_msg = " Name must be between 2-20 character";
                $name = $name;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $info_msg = "invalid mail";
                $email = $email;
            } elseif (strlen($pass) < 6 or strlen($pass) > 32 or empty($pass)) {
                $info_msg = "password must be between 6-32 long";
            } elseif ($conpass != $pass or empty($conpass)) {
                $info_msg = "Confirm password did not mach!";
            } else {
                $password = password_hash($conpass, PASSWORD_DEFAULT);
                $auth = md5(sha1($email . $pass));
                $username = strstr($email, '@', TRUE);
                $ip = $_SERVER['REMOTE_ADDR'];
                $insert = $main->insert("INSERT INTO users(id,name, username, email,role,pass, auth,ip) VALUES ('1','$name','$username','$email','global admin','$password','$auth','$ip')");
                if ($insert) {
                    $cookie_name = 'c_user';
                    $cookie_value = $auth;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 10), "/"); // 86400 = 1 day
                    header("location: ../../profile");
                    exit();
                } else {
                    echo "error registration.";
                }
            }
        } else {
            $trano = $email . ' already registared.';
        }
    }



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install</title>
    <link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php if (isset($info_msg)) { ?> <center>
            <div class="alert alert-info">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $info_msg; ?></div>
        </center><?php } ?>
        <div class="card ">
            <div class="card-header text-center ">
                Admin account:
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                value="<?php if (isset($name)) {
                                                                                                                            echo $name;
                                                                                                                        } ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                value="<?php if (isset($email)) {
                                                                                                                                echo $email;
                                                                                                                            } ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Confirm Email</label>
                            <input type="email" class="form-control" id="cemail" name="cemail"
                                placeholder="Confirm Email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input type="text" class="form-control" id="pass" name="pass" placeholder="Password"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Confirm Password</label>
                            <input type="text" class="form-control" id="cpass" name="cpass"
                                placeholder="Confirm Password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
            <div class="card-footer text-center">
                developed by <a href="https://google.com/search?q=developersharif" target="_blank">DeveloperSharif.</a>
            </div>
        </div>
    </div>
    <script src="../../lib/plugins/jquery/jquery.min.js"></script>
    <script src="../../lib/bootstrap/js/bootstrap.min.js"></script>
    <?php } ?>
</body>

</html>