<?php require('include/header.php');
if ($settings['site_status'] === 'on') {
    $main = new main();
    $user = new user();
    if ($user->check_usr() == false) {
        header("location: index");
        exit();
    }
    if (isset($_POST['submit']) and $_SERVER['REQUEST_METHOD'] == 'POST') {
        $validate = new validation();
        $main = new main();
        $user = new user();
        $format = new format();
        $user_id = $user->id();
        $fname = $validate->validate($_POST['fname']);
        $lname = $validate->validate($_POST['lname']);
        $phone = $validate->validate($_POST['phone']);
        $bio = $validate->validate($_POST['bio']);
        $querys = $main->update("UPDATE users SET name='$fname',lname='$lname',phone='$phone',bio='$bio' WHERE id='$user_id';");
        if ($querys) {
            $updatedmsg = "Updated";
        } else {
            echo "failed";
        }
    }
    $main_op = new main();
    $user_id = $user->id();
    $user_row = $main_op->db_query("users", "id", $user_id);
    if (!isset($user_id)) {
        echo "not logged";
    }
    if (isset($_POST['upload'])) {
        $img_cls = new image();
        $file_name = $user_row["username"] . $user_id . '-' . date('d.m.y') . '.png';
        $destination = "images/profile/" . $file_name;
        if ($img_cls->compress("file", $destination, 20)) {
            $main = new main();
            $user = new user();
            $user_id = $user->id();
            $avatar = $file_name;
            $querys = $main->update("UPDATE users SET avatar='$avatar' WHERE id='$user_id';");
            if ($querys) {
                $updatedmsg = "Updated";
            } else {
                echo "failed";
            }
        } else {
            echo "error";
        }
    }
    $user_row = $main_op->db_query("users", "id", $user_id);
    if ($user_row["avatar"] == '') {
        $avatar = 'avatar.png';
    } else {
        $avatar = $user_row["avatar"];
    }
?>

<body>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-sm-10 align-center">
                <h5><?php echo $user_row["name"] . " " . $user_row["lname"]; ?></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="text-center">
                    <img src="images/profile/<?php echo $avatar;  ?>" class="avatar img-circle img-thumbnail"
                        alt="avatar" style="width:40%;">
                    <h6>Upload Your photo...</h6>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" class="text-center center-block file-upload" name="file">
                </div>
                </hr>
                <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                </form>
                <br>


                <div class="panel panel-default">
                    <div class="d-none d-md-block panel-heading">Role: <?php echo $user_row["role"] ?></div>
                </div>
                <ul class="list-group d-md-none">
                    <li class="list-group-item text-muted">Activity<i class="fa fa-dashboard fa-1x"></i></li>
                    <li class="list-group-item "><span class="pull-left"><strong>Role:
                            </strong><?php echo $user_row["role"];  ?></span></li>
                    <li class="list-group-item "><a href="?post=published"><span
                                class="pull-left"><strong>Published</strong></span>
                            <?php echo $main->num_rows("select * from content WHERE uid='$user_id' and status='published'"); ?></a>
                    </li>
                    <li class="list-group-item "><a href="?post=pending"><span
                                class="pull-left"><strong>Pending</strong></span>
                            <?php echo $main->num_rows("select * from content WHERE uid='$user_id' and status='pending'"); ?></a>
                    </li>
                    <li class="list-group-item "><span class="pull-left"><strong>Banned</strong></span>
                        <?php echo $main->num_rows("select * from content WHERE uid='$user_id' and status='banned'"); ?>
                    </li>
                </ul>


            </div>
            <!--/col-3-->
            <div class="col-sm-9">

                <nav class="navbar navbar-expand navbar-light bg-light d-none d-md-block">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="?post=published">Published<span
                                        class="badge">(<?php echo $main->num_rows("select * from content WHERE uid='$user_id' and status='published'"); ?>)</span>
                                    <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="?post=pending">Pending(<?php echo $main->num_rows("select * from content WHERE uid='$user_id' and status='pending'"); ?>)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="#">Banned(<?php echo $main->num_rows("select * from content WHERE uid='$user_id' and status='banned'"); ?>)</a>
                            </li>
                        </ul>
                    </div>
                </nav> <?php if (!isset($_GET['post'])) { ?>
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <hr>
                        <form class="form" action="" method="post" id="registrationForm">
                            <div class="form-group">
                                <?php if (isset($updatedmsg)) { ?> <center>
                                    <div class="alert alert-success">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <?php echo $updatedmsg; ?></div>
                                </center><?php } ?>
                                <div class="col-xs-6">
                                    <label for="first_name">
                                        <h5>First name</h5>
                                    </label>
                                    <input type="text" class="form-control" name="fname" id="first_name"
                                        placeholder="first name" title="enter your first name if any."
                                        value="<?php echo $user_row["name"]; ?>">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="last_name">
                                        <h5>Last name</h5>
                                    </label>
                                    <input type="text" class="form-control" name="lname" id="last_name"
                                        placeholder="last name" title="enter your last name if any."
                                        value="<?php echo $user_row["lname"]; ?>">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="phone">
                                        <h5>Phone</h5>
                                    </label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                        placeholder="enter phone" title="enter your phone number if any."
                                        value="<?php echo $user_row["phone"]; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="email">
                                        <h5>Email</h5>
                                    </label>
                                    <input type="email" class="form-control" name="email" id="email" disabled="true"
                                        value="<?php echo $user_row["email"]; ?>" style="color:gray;">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-xs-6">
                                    <label for="email">
                                        <h5>Bio</h5>
                                    </label>
                                    <input type="text" class="form-control" id="location" name="bio" placeholder="Bio"
                                        title="Type your Bio" value="<?php echo $user_row["bio"]; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-lg btn-primary" name='submit' type="submit"><i
                                            class="glyphicon glyphicon-ok-sign"></i> Update</button>
                                    <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i>
                                        Reset</button>
                                </div>
                            </div>
                        </form>
                        <?php } elseif (isset($_GET['post']) and $_GET['post'] == 'published') { ?>
                        <?php
                                $format = new format();
                                $published = $main->select("select * from content where status='published' and uid='$user_id' order by id desc");
                                while ($post = $published->fetch_assoc()) {

                                ?>
                        <div class="p-post">
                            <a href="article.php?id=<?php echo $post["id"]; ?>"
                                class="list-group-item list-group-item-action">
                                <img src="images/thumb/<?php echo $post["thumb"]; ?>" /><?php echo $post["title"]; ?><a
                                    href="edit.php?id=<?php echo $post['id']; ?>" style="float:right;">Edit</a>
                                <div class="post-info">
                                    <div class="row">
                                        <div class="col"><?php echo $format->views($post["views"]); ?> views</div>
                                        <div class="col"><?php echo $format->time_ago($post["date"]); ?></div>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <hr>


                        <?php
                                }
                            } elseif (isset($_GET['post']) and $_GET['post'] == 'pending') { ?>
                        <?php
                                $format = new format();
                                $published = $main->select("select * from content where status='pending' and uid='$user_id'");
                                while ($post = $published->fetch_assoc()) {

                                ?>
                        <div class="p-post">
                            <a href="edit.php?id=<?php echo $post["id"]; ?>"
                                class="list-group-item list-group-item-action">
                                <img src="images/thumb/<?php echo $post["thumb"]; ?>" /><?php echo $post["title"]; ?>
                                <div class="post-info">
                                    <div class="row">
                                        <div class="col"><?php echo $format->views($post["views"]); ?> views</div>
                                        <div class="col"><?php echo $format->time_ago($post["date"]); ?></div>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <?php
                                }
                            } ?>
                    </div>
                    <!--/col-9-->
                </div>
                <!--/row-->
            </div>
        </div>
    </div>
    <script src="/javascripts/application.js" type="text/javascript" charset="utf-8" async defer>
    $(document).ready(function() {


        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(".file-upload").on('change', function() {
            readURL(this);
        });
    });
    </script>
</body>
<?php include("include/footer.php"); ?>

</html>
<?php } else { ?>
<center>
    <h3>Under Maintenance</h3>
</center>
<?php } ?>