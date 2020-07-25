<?php
require("include/header.php");
$main = new main();
$admin = new admin();
$user = new user();
$format = new format();
$Published = $main->num_rows("select * from content where status='published'");
$totall_posts = $main->num_rows("select * from content");
$authors = $main->num_rows("select * from users where role='author'");
$totall_member = $main->num_rows("select * from users");


if (isset($_GET['action']) and isset($_GET['id'])) {
    $action_msg = $admin->action_post($_GET['action'], $_GET['id']);
}
if (isset($_GET['role']) and isset($_GET['id'])) {
    $action_msg = $admin->action_user($_GET['id'], $_GET['role']);
}

?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="../" target="_blank">View Website</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <?php if (isset($action_msg)) {
            echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' . $action_msg . '</div>';
        }
        ?>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">CPU Traffic</span>
                        <span class="info-box-number">
                            10
                            <small>%</small>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Authors</span>
                        <span class="info-box-number"><?php echo $authors; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-paper-plane"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Published</span>
                        <span
                            class="info-box-number"><?php echo number_format($Published) . " of " . $totall_posts; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Totall Members</span>
                        <span class="info-box-number"><?php echo number_format($totall_member); ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
                <!-- TABLE: LATEST ORDERS -->
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Latest Posts</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $limit = 10;
                                    $query = $main->select("select * from content order by id desc limit $limit");
                                    while ($row = $query->fetch_assoc()) {

                                    ?>


                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><a
                                                href="posts.php?id=<?php echo $row['id'];  ?>"><?php echo $row['title']; ?></a>
                                        </td>
                                        <td><span class="badge badge-<?php if ($row['status'] == 'published') {
                                                                                echo "success";
                                                                            } elseif ($row['status'] == 'pending') {
                                                                                echo "warning";
                                                                            } elseif ($row['status'] == "banned") {
                                                                                echo "danger";
                                                                            } ?>"><?php echo $row['status']; ?></span>
                                        </td>
                                        <td>
                                            <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                <?php echo $format->time_ago($row['date']); ?></div>
                                        </td>



                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary"><a
                                                        href="?action=publish&id=<?php echo $row['id']; ?>"
                                                        class="text-white">Publish</a></button>
                                                <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a class="dropdown-item"
                                                            href="?action=pending&id=<?php echo $row['id']; ?>">Pending</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="?action=ban&id=<?php echo $row['id']; ?>">Ban</a></li>
                                                    <li><a class="dropdown-item"
                                                            href="?action=delete&id=<?php echo $row['id']; ?>">Delete</a>
                                                    </li>

                                                </ul>
                                            </div>


                                        </td>
                                    </tr>



                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                    <!--pagination goes here-->
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->



                <div class="row">


                    <div class="col-md-6">
                        <!-- USERS LIST -->
                        <div class="card collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Latest Members</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                            class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <ul class="users-list clearfix">
                                    <?php
                                    $query = $main->select("select * from users order by id desc limit 25");
                                    while ($row = $query->fetch_assoc()) {
                                    ?>
                                    <li data-toggle="modal" data-target="#<?php echo $row["username"]; ?>">
                                        <img src="../images/profile/<?php echo $row['avatar']; ?>">
                                        <a class="users-list-name"
                                            href="#"><?php echo $row['name'] . " " . $row['lname'];  ?></a>
                                        <span
                                            class="users-list-date"><?php echo $format->time_ago($row['reg_date']); ?></span>

                                        <div class="modal fade" id="<?php echo $row["username"]; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><?php echo $row['username']; ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <!-- Widget: user widget style 1 -->
                                                        <div class="card card-widget widget-user">
                                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                                            <div class="widget-user-header bg-info">
                                                                <h3 class="widget-user-username">
                                                                    <?php echo $row['name'] . " " . $row['lname']; ?>
                                                                </h3>
                                                                <h5 class="widget-user-desc"><?php echo $row['role']; ?>
                                                                </h5>
                                                            </div>
                                                            <div class="widget-user-image">
                                                                <img class="img-circle elevation-2"
                                                                    src="../images/profile/<?php echo $row['avatar']; ?>"
                                                                    alt="User Avatar">
                                                            </div>

                                                            <?php
                                                                $user_id = $row['id'];
                                                                $pub_post = $main->num_rows("select * from content where uid='$user_id' and status='published'");
                                                                $pen_post = $main->num_rows("select * from content where uid='$user_id' and status='pending'");
                                                                $ben_post = $main->num_rows("select * from content where uid='$user_id' and status='banned'");
                                                                $admin_tbl = $main->db_query("admin", "uid", "$user_id");
                                                                $admin_status = $admin_tbl['role'];
                                                                ?>

                                                            <div class="card-footer">
                                                                <div class="row">
                                                                    <div class="col-sm-4 border-right">
                                                                        <div class="description-block">
                                                                            <h5 class="description-header">
                                                                                <?php echo $pub_post; ?></h5>
                                                                            <span
                                                                                class="description-text">Published</span>
                                                                        </div>
                                                                        <!-- /.description-block -->
                                                                    </div>
                                                                    <!-- /.col -->
                                                                    <div class="col-sm-4 border-right">
                                                                        <div class="description-block">
                                                                            <h5 class="description-header">
                                                                                <?php echo $pen_post; ?></h5>
                                                                            <span
                                                                                class="description-text">Pending</span>
                                                                        </div>
                                                                        <!-- /.description-block -->
                                                                    </div>
                                                                    <!-- /.col -->
                                                                    <div class="col-sm-4">
                                                                        <div class="description-block">
                                                                            <h5 class="description-header">
                                                                                <?php echo $ben_post; ?></h5>
                                                                            <span class="description-text">Banned</span>
                                                                        </div>
                                                                        <!-- /.description-block -->
                                                                    </div>
                                                                    <!-- /.col -->
                                                                </div>
                                                                <div class="btn-group">
                                                                    <?php if ($row['role'] == 'author' or $row['role'] == 'subscriber' or $row['role'] == 'editor' or $row['role'] == 'ban' or $row['role'] == 'admin') { ?>
                                                                    <button type="button" class="btn btn-success"><a
                                                                            href="?role=author&id=<?php echo $row['id']; ?>"
                                                                            class="text-white">Make Author</a></button>
                                                                    <div class="btn-group">
                                                                        <button type="button"
                                                                            class="btn btn-info dropdown-toggle"
                                                                            data-toggle="dropdown">
                                                                            <span class="caret"></span></button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li><a class="dropdown-item"
                                                                                    href="?role=subscriber&id=<?php echo $row['id']; ?>">Subscriber</a>
                                                                            </li>
                                                                            <li><a class="dropdown-item"
                                                                                    href="?role=editor&id=<?php echo $row['id']; ?>">Editor</a>
                                                                            </li>
                                                                            <?php if ($row['role'] != "moderator") { ?>
                                                                            <li><a class="dropdown-item"
                                                                                    href="?role=moderator&id=<?php echo $row['id']; ?>">Moderator</a>
                                                                            </li><?php } ?>
                                                                            <li><a class="dropdown-item"
                                                                                    href="?role=admin&id=<?php echo $row['id']; ?>">Admin</a>
                                                                            </li>
                                                                            <li><a class="dropdown-item"
                                                                                    href="?role=ban&id=<?php echo $row['id']; ?>">#Ban</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <?php } elseif ($admin_status == 'global admin') { ?>
                                                                    <button type="button" class="btn btn-primary"><a
                                                                            href="" class="text-white">Global
                                                                            Admin</a></button>
                                                                    <?php } elseif ($row['role'] == 'moderator') { ?>

                                                                    <button type="button" class="btn btn-danger"><a
                                                                            href="?role=rmod&id=<?php echo $row['id']; ?>"
                                                                            class="text-white">Remove
                                                                            Moderator</a></button>

                                                                    <?php } ?>
                                                                </div>
                                                                <!-- /.row -->
                                                            </div>
                                                        </div>
                                                        <!-- /.widget-user -->

                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary"><a href=""
                                                                class="text-white">View</a></button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->


                                    </li>
                                    <?php } ?>
                                </ul>




                                <!-- /.users-list -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-center">
                                <a href="javascript::">View All Users</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!--/.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.col -->



            <div class="col-md-4">
                <!-- Info Boxes Style 2 -->
                <div class="info-box mb-3 bg-warning">
                    <span class="info-box-icon"><i class="fas fa-user"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Admin</span>
                        <span class="info-box-number"><?php echo $admin->admin_tbl('admin'); ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <div class="info-box mb-3 bg-success">
                    <span class="info-box-icon"><i class="fa fa-laptop"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Moderator</span>
                        <span class="info-box-number"><?php echo $admin->admin_tbl('moderator'); ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <div class="info-box mb-3 bg-danger">
                    <span class="info-box-icon"><i class="fas fa-edit alt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Editor</span>
                        <span class="info-box-number"><?php echo $admin->admin_tbl('editor'); ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <div class="info-box mb-3 bg-info">
                    <span class="info-box-icon"><i class="fa fa-ban"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Banned</span>
                        <span class="info-box-number"><?php echo $admin->admin_tbl('banned'); ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->




                <!-- PRODUCT LIST -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Recently Added Post</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <?php
                        $result = $main->select("SELECT content.id,content.uid,content.title,content.thumb,content.content,content.category,content.date, content.status,content.views, users.name FROM content INNER JOIN users ON content.uid=users.id and content.status='published' ORDER BY id DESC");
                        while ($post = $result->fetch_assoc()) {
                        ?>
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                            <li class="item">
                                <div class="product-img">
                                    <img src="../images/thumb/<?php echo $post['thumb']; ?>" class="img-size-50">
                                </div>
                                <div class="product-info">
                                    <a href="posts.php?id=<?php echo $post['id'];  ?>"
                                        class="product-title"><?php echo $post['title']; ?>
                                        <span
                                            class="badge badge-info float-right"><?php echo $post['category']; ?></span></a>
                                    <span class="product-description auto img-size-50">

                                    </span>
                                </div>
                            </li>

                            <!-- /.item -->

                        </ul>
                        <?php } ?>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <a href="posts.php" class="uppercase">View All</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer d-none">
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.4
    </div>
</footer>
<?php require('include/footer.php'); ?>