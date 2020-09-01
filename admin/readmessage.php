<?php require("include/header.php");
$main = new main();
$msg_id = $_GET['id'];
$update_status = $main->update("update contact set status='1' where id='$msg_id'");
$sql = "SELECT * FROM contact WHERE id='$msg_id'";
$query = $main->select($sql);
$inbox = $query->fetch_assoc();
$inbox_count = $main->num_rows("SELECT * FROM contact WHERE status='0'");
if (isset($_GET['action']) and $_GET['action'] == 'delete' and isset($_GET['id'])) {
  $d_id = $_GET['id'];
  $delete = $main->delete("DELETE FROM contact where id='$d_id'");
  if ($delete) {
    echo "<center>Deleted<br><a href='contact.php'>Inbox</a></center>";
    exit();
  } else {
    echo "Erro";
  }
}
?>
<link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <a href="contact.php" class="btn btn-primary btn-block mb-3">Back to Inbox</a>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Folders</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item active">
                                <a href="contact.php" class="nav-link">
                                    <i class="fas fa-inbox"></i> Inbox
                                    <span class="badge bg-primary float-right"><?php echo $inbox_count; ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-envelope"></i> Sent
                                </a>
                            </li>

                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <?php if (!isset($_GET['reply'])) { ?>
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Read Mail</h3>

                        <div class="card-tools">
                            <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i
                                    class="fas fa-chevron-left"></i></a>
                            <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Next"><i
                                    class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="mailbox-read-info">
                            <h5><?php echo $inbox['title']; ?></h5>
                            <h6>From: <?php echo $inbox['email']; ?>
                                <span class="mailbox-read-time float-right"><?php echo $inbox['date']; ?></span></h6>
                        </div>
                        <!-- /.mailbox-read-info -->

                        <!-- /.mailbox-controls -->
                        <div class="mailbox-read-message">
                            <p><?php echo $inbox['message']; ?></p>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="button" class="btn btn-default"><a
                                    href="?id=<?php echo $inbox['id']; ?>&reply"><i
                                        class="fas fa-reply"></i>Reply</a></button>
                        </div>
                        <button type="button" class="btn btn-default"><a
                                href="?action=delete&id=<?php echo $inbox['id']; ?>"><i class="far fa-trash-alt"></i>
                                Delete</a></button>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
                <?php } elseif (isset($_GET['reply'])) { ?>
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Send Mail</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="sendmail.php" method="POST">
                            <div class="form-group">
                                <input class="form-control" name="to" placeholder="To:"
                                    value="<?php echo $inbox['email']; ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="sub" placeholder="Subject" required>
                            </div>
                            <div class="form-group">
                                <textarea id="compose-textarea" name="body" class="form-control" style="height: 300px"
                                    placeholder="Body" required></textarea>
                            </div>
                            <input type="hidden" name="redirect" value="contact.php">
                            <input type="hidden" name="send_mail" value="true">
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="submit" name="submit" class="btn btn-primary"><i class="far fa-envelope"></i>
                                Send</button>
                        </div>
                        <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
                    </div>
                    </form>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
                <?php } ?>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</section>
<!-- /.content -->

<?php require("include/footer.php"); ?>