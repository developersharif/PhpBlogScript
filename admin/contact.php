<?php
require("include/header.php");
$main=new main();
$format=new format();
$sql="SELECT * FROM contact ORDER BY id DESC";
$query=$main->select($sql);
$inbox_count=$main->num_rows("SELECT * FROM contact WHERE status='0'");

?>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
        <?php     if ( $_GET['status']==='true') {
        $info_msg = "Mail has benn send!";
    } if (isset($info_msg) &  $_GET['status']==='true' ) { ?> <center>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $info_msg; ?></div>
            </center><?php }elseif($_GET['status']==='false'){ ?>

                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     Something went wrong!</div>

            <?php } ?>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Folders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <a href="#" class="nav-link">
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
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Inbox</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="Search Mail">
                  <div class="input-group-append">
                    <div class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">

                <button type="button" class="btn btn-default btn-sm"><a href="contact.php"><i class="fas fa-sync-alt"></i></a></button>

                <!-- /.float-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  	<?php 
                    while ($inbox=$query->fetch_assoc()) {
                  	?>
                  <tr>
                    <td>
                      <div class="icheck-primary">
                        <input type="checkbox" value="" id="check1">
                        <label for="check1"></label>
                      </div>
                    </td>
                    <td class="mailbox-star"></td>
                    <td class="mailbox-name"><a href="readmessage.php?id=<?php echo $inbox['id']; ?>"> <?php if($inbox["status"]=='0'){echo "<b>";} ?><?php echo $inbox['title']; ?></a> <?php if($inbox["status"]=='0'){echo "</b>";} ?></td>
                    <td class="mailbox-subject"> <?php if($inbox["status"]=='0'){echo "<b>";} ?><?php echo substr($inbox['message'],0,100); ?> <?php if($inbox["status"]=='0'){echo "</b>";} ?>
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date"><?php echo $format->time_ago($inbox['date']); ?></td>
                   
                  </tr>
                  
                 <?php  }  ?>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              <div class="mailbox-controls">
                <div class="float-right">
                 
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->













<?php
require("include/footer.php");
?>