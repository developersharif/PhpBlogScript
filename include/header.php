<?php
require('include/classes.php');
date_default_timezone_set("asia/dhaka");
$main_cls = new main();
$user = new user();
$db_check = $main_cls->db_check();
if ($db_check != true) {
    header("location: system/install/index.php");
    exit;
}
$counter_cls=new counter();
$site_status = $main_cls->select("select * from settings");
$settings = $site_status->fetch_assoc();
$logo_obj = json_decode($settings['site_logo']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/assets/logo.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="lib/style.css">
    <script src="lib/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-176915971-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-176915971-1');
</script>

    <style>
    :root {
        --primary-color-bg: <?php echo $settings['site_color'];
        ?>;
        --primary-color-text: <?php echo $settings['font_color'];
        ?>;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-inverse navbar-fixed-top"
        style="background-color: <?php echo $settings['site_color'] ?>">
        <a class="navbar-brand" href="index.php" style="color: <?php echo $settings['font_color'] ?>"> <img
                src="images/assets/logo.png" alt="" height="<?php print $logo_obj->height; ?>"
                width="<?php print $logo_obj->width; ?>" />
            <?php echo $settings['site_name']; ?></a>
        <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            </ul>
            <div class="nav-item">
                <?php if ($user->check_usr() == false) { ?> <a class="nav-link" href="login"
                    style="color: <?php echo $settings['font_color']; ?>">sign
                    in</a><?php } ?>
            </div>
            <div class="nav-item">
                <?php if ($user->check_usr() == false) { ?> <a class="nav-link" href="signup"
                    style="color: <?php echo $settings['font_color']; ?>">sign
                    up</a><?php } ?>
            </div>
            <?php if ($user->check_usr()) { ?><div class="nav-item">
                <a class="nav-link" href="profile.php" style="color: <?php echo $settings['font_color']; ?>">Profile</a>
            </div><?php } ?>
            <?php if ($user->check_usr()) { ?><div class="nav-item">
                <a class="nav-link" href="composer.php" style="color: <?php echo $settings['font_color']; ?>">Add
                    Post</a>
            </div><?php } ?>
            <?php if ($user->query("role") == 'admin' or $user->query("role") == 'global admin') { ?><div
                class="nav-item">
                <a class="nav-link" href="admin" style="color: <?php echo $settings['font_color']; ?>">Admin</a>
            </div><?php } ?>
            <?php if ($user->check_usr()) { ?><div class="nav-item">
                <a class="nav-link" href="logout" style="color: <?php echo $settings['font_color']; ?>">Logout</a>
            </div><?php } ?>
        </div>
    </nav>
    <!--navbar end-->
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <noscript>
        <center>
            <h2 style="color:white;background-color:red;">
                <p class="noscript">Please Enable Javascript</p>
            </h2>
        </center>
    </noscript>