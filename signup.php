<?php
require("include/header.php");
$ip = new ip();
$validatin = new validation();
$main = new main();
$site_status = $main->select("select * from settings");
$settings = $site_status->fetch_assoc();
if ($settings['reg_status'] === 'on') {
    if (isset($_COOKIE['c_user'])) {
        header("location: index");
        exit();
    }
    if (isset($_POST['submit']) and $_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = $validatin->validate($_POST["fname"]);
        $lname = $validatin->validate($_POST["lname"]);
        $pnumber = $validatin->validate($_POST["pnumber"]);
        $email = $validatin->validate($_POST["email"]);
        $pass = htmlspecialchars($_POST["password"]);
        $conpass = htmlspecialchars($_POST["cpassword"]);
        $check = $main->select("select * from users where email='$email';");
        $checkmail = mysqli_num_rows($check);
        if ($checkmail == 0) {


            //validation
            if (strlen($fname) > 25 or strlen($fname) < 2 or empty($fname)) {
                $fnmsg = "First Name must be between 2-20 character";
                $fname = $fname;
            } elseif (strlen($lname) >= 20 or strlen($lname) < 2 or empty($lname)) {
                $lnmsg = "Last Name must be between 2-20 character";
                $lname = $lname;
            } elseif (strlen($pnumber) >= 13 or empty($pnumber)) {
                $pnmsg = "Please Enter your valid number";
                $pnumber = $pnumber;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $mlmsg = "invalid mail";
                $email = $email;
            } elseif (strlen($pass) < 6 or strlen($pass) > 32 or empty($pass)) {
                $pamsg = "password must be between 6-32 long";
            } elseif ($conpass != $pass or empty($conpass)) {
                $conmsg = "Confirm password did not mach!";
            } else {
                $password = password_hash($conpass, PASSWORD_DEFAULT);
                $auth = md5(sha1($email . $pass));
                $username = strstr($email, '@', TRUE);
                $ip = $_SERVER['REMOTE_ADDR'];
                $insert = $main->insert("INSERT INTO users(name, lname, username, email, phone, role,pass, auth,ip) VALUES ('$fname','$lname','$username','$email','$pnumber','subscriber','$password','$auth','$ip')");
                if ($insert) {
                    $cookie_name = 'c_user';
                    $cookie_value = $auth;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 10), "/"); // 86400 = 1 day
                    header("location:profile");
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
    <title>Registration</title>
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="lib/style.css">
    <link rel="stylesheet" href="lib/fontawesome/css/all.css">
</head>

<body>
    <div class="container">
        <center><?php if (isset($trano)) { ?><div class="alert alert-Warning">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Warning!</strong> <?php if (isset($trano)) {
                                                        echo '<span>' . $trano . '</span>';
                                                    } ?>
            </div><?php } ?></center>
        <div class="frame signup">
            <h2> SIGN UP </h2>
            <form action="" method="post">
                <input type="text" name="fname" placeholder="First Name" value="<?php if (isset($fname)) {
                                                                                        echo $fname;
                                                                                    } ?>" required>
                <?php if (isset($fnmsg)) {
                        echo '<span>' . $fnmsg . '</span>';
                    } ?>

                <input type="text" name="lname" placeholder="Last Name" value="<?php if (isset($lname)) {
                                                                                        echo $lname;
                                                                                    } ?>" required>
                <?php if (isset($lnmsg)) {
                        echo '<span>' . $lnmsg . '</span>';
                    } ?>
                <input type="tel" name="pnumber" placeholder="Phone number" value="<?php if (isset($pnumber)) {
                                                                                            echo $pnumber;
                                                                                        } ?>" required>
                <?php if (isset($pnmsg)) {
                        echo '<span>' . $pnmsg . '</span>';
                    } ?>
                <input type="email" name="email" placeholder="email" value="<?php if (isset($email)) {
                                                                                    echo $email;
                                                                                } ?>" required>
                <?php if (isset($mlmsg)) {
                        echo '<span>' . $mlmsg . '</span>';
                    } ?>
                <input type="password" name="password" placeholder="password" required>
                <?php if (isset($pamsg)) {
                        echo '<span>' . $pamsg . '</span>';
                    } ?>
                <input type="password" name="cpassword" placeholder="Confirm password" required>
                <?php if (isset($conmsg)) {
                        echo '<span>' . $conmsg . '</span>';
                    } ?>
                <input type="submit" name="submit" value="submit">
            </form>
        </div>
    </div><!-- /.container -->
    <?php include("include/footer.php"); ?>
</body>

</html>
<?php } else {
    header("location: login.php");
}
?>