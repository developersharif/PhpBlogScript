<?php
require("classes.php");
$main = new main();
$admin = new admin();
$user = new user();
$format = new format();
if (isset($_COOKIE['c_user'])) {

    if ($admin->admin_check($_COOKIE['c_user']) == false) {
        header("location: logout");
        exit();
    }
} elseif (!isset($_COOKIE['c_user'])) {
    header("location: logout");
    exit();
}
$site_status = $main->select("select * from settings");
$settings = $site_status->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin::Dashboard </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <style>
    a .text-white {
        color: white;
    }

    .auto {
        overflow: auto;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark ">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="contact" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3" action="users" method="post">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" name="search" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <?php
            $csql = "SELECT * FROM contact WHERE status='0' ORDER BY id DESC";
            $query = $main->select($csql);
            $inbox_count = $main->num_rows("SELECT * FROM contact WHERE status='0'");
            ?>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge"><?php echo $inbox_count; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <?php while ($con_msg = $query->fetch_assoc()) { ?>
                            <!-- Message Start -->
                            <a href="readmessage.php?id=<?php echo $con_msg["id"]; ?>">
                                <div class="media">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            <?php echo $con_msg["title"];

                                                ?>
                                            <span class="float-right text-sm text-danger"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                            <?php echo $format->time_ago($con_msg["date"]); ?></p>
                                    </div>
                                </div>
                            </a>
                            <?php } ?>
                            <!-- Message End -->
                        </a>

                        <div class="dropdown-divider"></div>
                        <a href="contact" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
                            class="fas fa-th-large"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index" class="brand-link">
                <img src="../images/profile/<?php echo $user->query('avatar') ?>"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span
                    class="brand-text font-weight-light small"><?php echo strtoupper($settings["site_name"]); ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="categories" class="nav-link">
                                        <i class="fa fa-list-alt "></i>
                                        <p class="text">Categories</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="users" class="nav-link">
                                        <i class="fa fa-users "></i>
                                        <p class="text">Users</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="posts" class="nav-link">
                                        <i class="fa fa-list-alt "></i>
                                        <p class="text">Posts</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pageupdate" class="nav-link">
                                        <i class="fa fa-file "></i>
                                        <p class="text">Page Update</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="modaretors" class="nav-link">
                                        <i class="fa fa-gavel "></i>
                                        <p class="text">User roles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="status" class="nav-link">
                                        <i class="fa fa-area-chart " aria-hidden="true"> </i>
                                        <p class="text">Site Status</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="settings" class="nav-link">
                                        <i class="nav-icon fa fa-cogs "></i>
                                        <p class="text">Settings</p>
                                    </a>
                                </li>
                        </li>
                    </ul>
                    </li>
                    <li class="nav-item">
                        <a href="logout" class="nav-link">
                            <i class="nav-icon far fas fa-unlock"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                    &nbsp;
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">