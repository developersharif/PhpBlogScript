<?php
if (isset($_POST["btnsub"]) and $_SERVER["REQUEST_METHOD"]=="POST") {
require("configer/config.php");
require("classes/main_cls.php");
require("classes/validation.php");
$main=new main();
$validate=new validation();
$email=$validate->validate($_POST['email']);
$auth=md5(sha1($email.$_POST['password']));
$query=$main->select("SELECT * FROM users WHERE email='$email' and auth='$auth'");
$row=$query->fetch_assoc();
$dbpass=$row['pass'];
$check=mysqli_num_rows($query);
if (password_verify($_POST['password'], $dbpass) and $check==1) {
$cookie_name = 'c_user';
$cookie_value = $auth;
setcookie($cookie_name, $cookie_value, time() + (86400 * 10), "/"); // 86400 = 1 day
header("location:index.php?logged");
return 0;
} else {
 $error= "Your Entered Info is Wrong.";
}


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="lib/style.css">
    <link rel="stylesheet" href="lib/fontawesome/css/all.css">
    <style>
.login-form{
  margin: auto;
}
.form-signin {
  width: 100%;
  max-width: 420px;
  padding: 15px;
  margin: auto;
}

.form-label-group {
  position: relative;
  margin-bottom: 1rem;
}

.form-label-group > input,
.form-label-group > label {
  height: 3.125rem;
  padding: .75rem;
}

.form-label-group > label {
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  margin-bottom: 0; /* Override default `<label>` margin */
  line-height: 1.5;
  color: #495057;
  pointer-events: none;
  cursor: text; /* Match the input under the label */
  border: 1px solid transparent;
  border-radius: .25rem;
  transition: all .1s ease-in-out;
}

.form-label-group input::-webkit-input-placeholder {
  color: transparent;
}

.form-label-group input:-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-moz-placeholder {
  color: transparent;
}

.form-label-group input::placeholder {
  color: transparent;
}

.form-label-group input:not(:placeholder-shown) {
  padding-top: 1.25rem;
  padding-bottom: .25rem;
}

.form-label-group input:not(:placeholder-shown) ~ label {
  padding-top: .25rem;
  padding-bottom: .25rem;
  font-size: 12px;
  color: #777;
}

/* Fallback for Edge
-------------------------------------------------- */
@supports (-ms-ime-align: auto) {
  .form-label-group > label {
    display: none;
  }
  .form-label-group input::-ms-input-placeholder {
    color: #777;
  }
}

/* Fallback for IE
-------------------------------------------------- */
@media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
  .form-label-group > label {
    display: none;
  }
  .form-label-group input:-ms-input-placeholder {
    color: #777;
  }
}
    </style>
</head>

<body>
  <div class="login-form">
 <?php if(isset( $error)){?>
  <center><div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>#</strong>    <?php echo $error; ?>
</div></center><?php }?>
    <div class="align-center">Login</div>
<form class="form-signin" action="" method="post">
  <div class="form-label-group">
    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputEmail">Email address</label>
  </div>

  <div class="form-label-group">
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
    <label for="inputPassword">Password</label>
  </div>

  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" name="btnsub" type="submit">Sign in</button>
</form>
<div class="reglink"><a href="signup.php">Join Now</a></div>
</div>
&nbsp;
&nbsp;
&nbsp;
&nbsp;
&nbsp;
 <section class="footer bg-black">
              <div class="container-fluid">
               <div class="row">
                 <div class="col-md-6 col-6">
                   <div class="list-group">
                     <a href="index.php">Home</a>              
                     <a href="">About us</a>              
                     <a href="">tearms</a>             
                     <a href="">privacy policy</a>
                   </div>
                 </div>
                 <div class="col-md-6 col-6">
                      <div class="list-group">
                     <a href="">join now</a>              
                    <a href="">sign in</a>                 
                     <a href="">Contact us</a>
                 </div>
               </div>
               <div class="col">
                &nbsp;
                  <div class="align-center small">&copy; 2020 by blogName. All Rights Reserved.</div> 
               </div>
              </div>
             </section>
  <script src="lib/jquery.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="lib/fontawesome/js/all.js"></script>
</body>
</html>

