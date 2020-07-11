<?php
require('include/classes.php');
date_default_timezone_set("asia/dhaka");
$user=new user();
$main_cls=new main();
$site_status=$main_cls->select("select * from settings");
$settings=$site_status->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="lib/style.css">
    <link rel="stylesheet" href="lib/fontawesome/css/all.css">
  <script src="lib/jquery.min.js" type="text/javascript" charset="utf-8"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light navbar-inverse navbar-fixed-top" style="background-color: <?php echo $settings['site_color'] ?>">
  <a class="navbar-brand" href="index.php" style="color: white"><?php echo $settings['site_name']; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
     
</ul>
     <div class="nav-item">
       <?php  if ($user->check_usr()==false) {?> <a class="nav-link" href="login.php" style="color: white">sign in</a><?php } ?>
      </div> 
       <?php  if ($user->check_usr()) {?><div class="nav-item">
      <a class="nav-link" href="profile.php" style="color: white">Profile</a>
      </div><?php }?>
      <?php  if ($user->check_usr()) {?><div class="nav-item">
      <a class="nav-link" href="composer.php" style="color: white">Add Post</a>
      </div><?php }?>
      <?php  if ($user->query("role")=='admin' or $user->query("role")=='global admin') {?><div class="nav-item">
      <a class="nav-link" href="admin" style="color: white">Admin</a>
      </div><?php }?>
  </div>
</nav><!--navbar end-->
<noscript><center><h2 style="color:white;background-color:red;"><p class="noscript">Please Enable Javascript</p></h2></center></noscript>
