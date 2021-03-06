<?php require("include/header.php");
$main = new main();
$admin = new admin();
$user = new user();
$format = new format();
$img = new image();


if (isset($_POST["settings"])) {

    if (isset($_POST["site_name"])) {
        $name = $_POST['site_name'];
        $update = $main->update("update settings set site_name ='$name';");
        if ($update) {
            $stg_msg = "Setting updated.";
        } else {
            echo "error";
        }
    } elseif (isset($_POST["title"])) {
        $title = $_POST['title'];
        $update = $main->update("update settings set site_title ='$title';");
        if ($update) {
            $stg_msg = "Setting updated.";
        } else {
            echo "error";
        }
    } elseif (isset($_POST["description"])) {
        $description = $_POST['description'];
        $update = $main->update("update settings set site_description ='$description';");
        if ($update) {
            $stg_msg = "Setting updated.";
        } else {
            echo "error";
        }
    } elseif (isset($_FILES["logo"])) {
        $file = $_FILES["logo"];
        $file_type = $file['type'];
        if ($file_type == "image/gif" || $file_type == "image/jpeg" || $file_type == "image/png" || $file_type == "image/pjpeg") {
            $destination = "../images/assets/logo.png";
            $img->upload('logo', $destination);
            $height = $_POST["height"];
            $width = $_POST["width"];
            if (empty($height) and empty($width)) {
                $height = 50;
                $width = 50;
            }
            $array = array("logo" => "logo.png", "height" => "$height", "width" => "$width");
            $jsobj = json_encode($array);
            $update = $main->update("update settings set site_logo ='$jsobj';");
            if ($update) {
                $stg_msg = "Added";
            } else {
                echo "error";
            }
        } else {
            $stg_msg = "file type does not exist";
        }
    } elseif (isset($_FILES["bannar"])) {
        $destination = "../images/assets/bannar.png";
        $img->compress('bannar', $destination, 20);
        $update = $main->update("update settings set site_banner ='bannar.png';");
        if ($update) {
            $stg_msg = "Added";
        } else {
            $stg_msg = "error";
        }
    } elseif (isset($_POST["color"])) {
        $color = $_POST['color'];
        $update = $main->update("update settings set site_color ='$color';");
        if ($update) {
            $stg_msg = "Setting updated.";
        } else {
            $stg_msg = "error";
        }
    } elseif (isset($_POST["font-color"])) {
        $tcolor = $_POST['font-color'];
        $update = $main->update("update settings set font_color ='$tcolor';");
        if ($update) {
            $stg_msg = "Setting updated.";
        } else {
            $stg_msg = "error";
        }
    } elseif (isset($_POST["darkmode"])) {
        $dark = $_POST['darkmode'];
        $update = $main->update("update settings set dark_mode='$dark';");
        if ($update) {
            $stg_msg = "Setting updated.";
        } else {
            $stg_msg = "error";
        }
    } elseif (isset($_POST["post_status"])) {
        $post_status = $_POST['post_status'];
        $update = $main->update("update settings set new_post ='$post_status';");
        if ($update) {
            $stg_msg = "Setting updated.";
        } else {
            $stg_msg = "error";
        }
    } elseif (isset($_POST["perpage_post"])) {
        $perpage = $_POST['perpage_post'];
        $update = $main->update("update settings set perpage_post ='$perpage';");
        if ($update) {
            $stg_msg = "Setting updated.";
        } else {
            $stg_msg = "error";
        }
    } elseif (isset($_POST["reg_status"])) {
        $reg_status = $_POST['reg_status'];
        $update = $main->update("update settings set reg_status ='$reg_status';");
        if ($update) {
            $stg_msg = "Setting updated.";
        } else {
            $stg_msg = "error";
        }
    } elseif (isset($_POST["site_status"])) {
        $site_status = $_POST['site_status'];
        $update = $main->update("update settings set site_status ='$site_status';");
        if ($update) {
            $stg_msg = "Setting updated.";
        } else {
            $stg_msg = "error";
        }
    } elseif (isset($_POST["notice"])) {
        $notice = $_POST['notice'];
        $update = $main->update("update settings set notice ='$notice';");
        if ($update) {
            $stg_msg = "Setting updated.";
        } else {
            echo "error";
        }
    }
} //if end


?>
<!-- Default box -->

<?php if (isset($stg_msg)) { ?>
<div class="alert alert-info">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php echo $stg_msg; ?>
</div>
<?php } ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Settings</h3>
        <div class="card-tools">
            <a href="settings.php">&nbsp;Refresh&nbsp;</a>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped projects">

            <tbody>
                <?php
                $Set_query = $main->select("select * from settings ");
                $settings = $Set_query->fetch_assoc();


                ?>
                <tr>
                    <td>
                        <a>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Site Name:
                        </a>

                    </td>
                    <td>
                        <?php echo $settings['site_name']; ?>
                    </td>

                    <td class="project-actions text-right">

                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#site_name">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <div class="modal fade" id="site_name">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Site Name</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            <p><textarea class="form-control"
                                                    name="site_name"><?php echo $settings['site_name']; ?> </textarea>
                                            </p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="settings">Save
                                                changes</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </td>
                </tr>
                <tr>
                    <td>
                        <a>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Site Title:
                        </a>

                    </td>
                    <td>
                        <?php echo $settings['site_title']; ?>
                    </td>

                    <td class="project-actions text-right">

                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#site_title">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>

                        <div class="modal fade" id="site_title">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Site title</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <p><textarea class="form-control"
                                                    name="title"><?php echo $settings['site_title']; ?> </textarea></p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="settings" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                    </td>
                </tr>
                <tr>
                    <td>
                        <a>
                            <i class="fa fa-info" aria-hidden="true"></i> Description:
                        </a>

                    </td>
                    <td>
                        <?php echo $settings['site_description']; ?>
                    </td>

                    <td class="project-actions text-right">

                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#site_des">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <div class="modal fade" id="site_des">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Site Description</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <p><textarea class="form-control"
                                                    name="description"><?php echo $settings['site_description']; ?> </textarea>
                                            </p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="settings" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </td>
                </tr>
                <tr>
                    <td>
                        <a>
                            <i class="fa fa-file-image-o" aria-hidden="true"></i> Logo
                        </a>

                    </td>
                    <td>
                        <?php $logoobj = json_decode($settings['site_logo']); ?>
                        <img src="../images/assets/logo.png" height="<?php echo $logoobj->height; ?>"
                            width="<?php echo $logoobj->width; ?>" />
                    </td>

                    <td class="project-actions text-right">

                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#site_logo">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <div class="modal fade" id="site_logo">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Logo</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <p><input type="file" name="logo">
                                                <input type="number" name="height" placeholder="Logo Height">
                                                <input type="number" name="width" placeholder="Logo Width"></p>
                                            <p class="small">By default: 50*50</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="settings" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </td>
                </tr>
                <tr>
                    <td>
                        <a>
                            <i class="fa fa-picture-o" aria-hidden="true"></i> Site Banner
                        </a>

                    </td>
                    <td>
                        <img src="../images/assets/bannar.png" style="max-height: 50px;" />
                    </td>

                    <td class="project-actions text-right">

                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#site_bannar">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <div class="modal fade" id="site_bannar">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?php echo $settings['site_name']; ?></h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <p><input type="file" name="bannar" /></p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="settings" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </td>
                </tr>
                <tr>
                    <td>
                        <a>
                            <i class="fa fa-bell-o" aria-hidden="true"></i> Notice:
                        </a>

                    </td>
                    <td>
                        <?php echo $settings['notice']; ?>
                    </td>

                    <td class="project-actions text-right">

                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#site_notice">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <div class="modal fade" id="site_notice">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Global Notice For All Users</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <p><input type="text" value="<?php echo $settings['notice']; ?>"
                                                    name="notice"></p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="settings" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </td>
                </tr>

                <tr>
                    <td>
                        <a>
                            <i class="fas fa-fill" aria-hidden="true"></i> Primary Color:
                        </a>

                    </td>
                    <td>
                        <input type="color" value="<?php echo $settings['site_color']; ?>" style="width: 100px;
    border: none;" disabled>
                    </td>

                    <td class="project-actions text-right">

                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#site_color">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <div class="modal fade" id="site_color">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Primary Color</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <input type="color" name="color"
                                                value="<?php echo $settings['site_color']; ?>"
                                                style="width:100%;height:80px;border:none;" />
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="settings" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </td>
                </tr>
                <tr>
                    <td>
                        <a>
                            <i class="fa fa-font" aria-hidden="true"></i> Font Color
                        </a>

                    </td>
                    <td>
                        <input type="color" value="<?php echo $settings['font_color']; ?>" style="width: 100px;
    border: none;" disabled>
                    </td>

                    <td class="project-actions text-right">

                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#font-color">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <div class="modal fade" id="font-color">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Font Color</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <input type="color" name="font-color"
                                                value="<?php echo $settings['font_color']; ?>"
                                                style="width:100%;height:80px;border:none;" />
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="settings" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </td>
                </tr>
                <tr>
                    <td>
                        <a>
                            <i class="fa fa-adjust" aria-hidden="true"></i> Dark Mode:
                        </a>

                    </td>
                    <td>
                        <?php echo $settings['dark_mode']; ?>
                    </td>

                    <td class="project-actions text-right">

                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#dark-mode">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <div class="modal fade" id="dark-mode">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Dark Mode:</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <select name="darkmode">
                                                <option value="on">On</option>
                                                <option value="off">Off</option>
                                            </select>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="settings" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </td>
                </tr>
                <tr>
                    <td>
                        <a>
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> New post:
                        </a>

                    </td>
                    <td>
                        <?php
                        $new_post = $settings['new_post'];
                        if ($new_post == 'off') {
                            echo "disabled";
                        } else {
                            echo "Enabled";
                        }


                        ?>
                    </td>

                    <td class="project-actions text-right">

                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#site_post">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <div class="modal fade" id="site_post">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">New post Permission for all user.</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <select name="post_status" id="">
                                                <option value="on">Enable</option>
                                                <option value="off">Disable</option>
                                            </select>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="settings" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </td>
                </tr>
                <tr>
                    <td>
                        <a>
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i> Perpage post:
                        </a>

                    </td>
                    <td>
                        <?php echo $settings['perpage_post']; ?>
                    </td>

                    <td class="project-actions text-right">

                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#perpage-post">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <div class="modal fade" id="perpage-post">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">How many post on first page</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <input type="number" name="perpage_post"
                                                value="<?php echo $settings['perpage_post']; ?>"
                                                placeholder="Total post in home page">
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="settings" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </td>
                </tr>

                <tr>
                    <td>
                        <a>
                            <i class="fa fa-user-plus" aria-hidden="true"></i> Registration Status:
                        </a>

                    </td>
                    <td>
                        <?php
                        $reg_status = $settings['reg_status'];
                        if ($reg_status == 'off') {
                            echo "disabled";
                        } else {
                            echo "Enabled";
                        }

                        ?>
                    </td>

                    <td class="project-actions text-right">

                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#reg_status">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <div class="modal fade" id="reg_status">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Registration Status:</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <select name="reg_status" id="">
                                                <option value="on">Enable</option>
                                                <option value="off">Disable</option>
                                            </select>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="settings" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </td>
                </tr>
                <tr>
                    <td>
                        <a>
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Maintenance Mode:
                        </a>

                    </td>
                    <td>
                        <?php
                        $Maintenance_status = $settings['site_status'];
                        if ($Maintenance_status == 'on') {
                            echo "disabled";
                        } else {
                            echo "Enabled";
                        }

                        ?>
                    </td>

                    <td class="project-actions text-right">

                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#site_status">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <div class="modal fade" id="site_status">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Maintenance_status</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <select name="site_status" id="">
                                                <option value="on">Disable</option>
                                                <option value="off">Enable</option>
                                            </select>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="settings" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->






























<?php include("include/footer.php"); ?>