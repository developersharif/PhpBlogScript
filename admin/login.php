<?php
require("include/classes.php");
$admin = new admin();
$user = new user();
$main = new main();
if (isset($_COOKIE['c_user']) and $admin->admin_check($_COOKIE['c_user']) == true) {
  header("location: index.php");
  exit();
} elseif (isset($_POST['submit'])) {
  $valide = new validation();
  if (isset($_POST['submit']) and !empty(trim($_POST['email'])) and !empty($_POST['password']) and $_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $valide->validate($_POST['email']);
    $pass = $_POST['password'];
    $db_query = $main->db_query("users", "email", $email);
    $db_pass = $db_query['pass'];
    $user_id = $db_query['id'];
    if (password_verify($pass, $db_pass)) {
      $num_rows = $query = $main->num_rows("SELECT * FROM admin WHERE uid=$user_id");
      if ($num_rows == 1) {
        $auth = md5(sha1($email . $_POST['password']));
        $cookie_name = 'c_user';
        $cookie_value = $auth;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 10), "/"); // 86400 = 1 day
        header("location: index.php?loged");
      } else {
        header("location: ../login.php");
      }
    } else {
      echo '<div class"alert alert-warning">Wrong Input</div>';
    }
  }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin::Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b><?php $site_status = $main->select("select * from settings");
          $settings = $site_status->fetch_assoc();
          echo $settings["site_name"];
          ?></b>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Admin Login</p>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>



                <p class="mb-1">

                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

</body>

</html>