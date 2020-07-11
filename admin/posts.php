<?php
require("include/header.php");
$main=new main();
$admin=new admin();
$user=new user();
$format=new format();
if (isset($_GET['action']) and isset($_GET['id'])) {
  $action_msg=$admin->action_post($_GET['action'],$_GET['id']);
}
?>
<?php if(isset($_GET['add_post'])){  ?>
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12 col">
          <div class="card card-outline card-info">
            <div class="card-header">
             <?php if(isset($submited)){ ?> <center><div class="alert alert-success">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <?php echo $submited;?></div></center><?php }?>
              <!-- tools box -->
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"title="Collapse">
                  <i class="fas fa-minus"></i></button> 
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body pad">
               <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <div class="col-xs-6">
                            <label for="last_name"><h6>Title</h6></label>
                              <input type="text" class="form-control" name="title" id="last_name" placeholder="Title" title="Write your post title" required="true">
                          </div>
                      </div>
                     <div class="form-group">
                          <div class="col-xs-6">
                            <label for="categories"><h6>category</h6></label>
                            <select name="category" id="categories" class="form-control">
                              <?php 
                              $main=new main();
                              $select=$main->select("select category from categories where role='user' or role='admin' order by category;");
                              while ($cate=$select->fetch_assoc()){
                              ?>
                             <option value="<?php echo $cate['category']; ?>"><?php echo $cate['category']; ?></option>
                             <?php }?>
                            </select>  
                          </div>
                      </div>
              <div class="mb-3">
                <label for="content"><h6>Content</h6></label>
                <textarea class="textarea content" placeholder="Place some text here" name="content" 
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
              </div>
              <div class="mb-3">
                <label for="content"><h6>Thumbnail</h6></label>
                <input type="file" name="thumb" class="form-control" required>
              </div>
              <input class="btn btn-submit btn-success align-right"type="submit" value="Submit" name="submit"></input>
            </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php }elseif(!isset($_GET['id'])){ ?>
<center><a href="?add_post" class="btn btn-success">Add Post</a></center>
<a href="posts.php" style="float:right;">Refresh</a><br>
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
        $limit=100;
        $query=$main->select("select * from content order by id desc limit $limit");
        while ($row=$query->fetch_assoc()) {
  
        ?>


                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><a href="?id=<?php echo $row['id']; ?>" ><?php echo $row['title']; ?></a> 
                     </td>
                      <td><span class="badge badge-<?php if($row['status']=='published'){echo "success";}elseif($row['status']=='pending'){echo "warning";}elseif($row['status']=="banned"){echo "danger";} ?>"><?php echo $row['status']; ?></span></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo $format->time_ago($row['date']); ?></div>
                      </td>


                      <td>  
<div class="btn-group">
  <button type="button" class="btn btn-success"><a href="?action=publish&id=<?php echo $row['id']; ?>" class="text-white">Publish</a></button>
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a class="dropdown-item" href="?action=pending&id=<?php echo $row['id']; ?>">Pending</a></li>
    <li><a class="dropdown-item" href="?action=ban&id=<?php echo $row['id']; ?>">Ban</a></li>
    <li><a class="dropdown-item" href="?action=delete&id=<?php echo $row['id']; ?>">Delete</a></li>
    
  </ul>
</div>
       </td>
            </tr> 
                <?php }?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <!-- /.card-footer -->
            </div>
<?php }elseif(isset($_GET['id']) and $_GET['id']!=''){ ?>

<?php 
$post_id=$_GET['id'];
$query=$main->select("select * from content where id='$post_id'");
$post=$query->fetch_assoc();
$check=$main->num_rows("select * from content where id='$post_id'");
if($check==1){
?>


          
<section class="content">
      <div class="container-fluid">
<div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title"><?php echo $post["title"];?>>><?php echo $post["category"];?>>><?php echo $post["date"];?></h3>

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
                 <?php echo $post["content"];?>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
               <!--pagination goes here-->
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
        </section>









<?php }else{echo "not found!";} } ?>

       <?php if (isset($_POST["submit"]) and !empty(trim($_POST['content'])) and $_SERVER['REQUEST_METHOD'] == "POST" and !empty(trim($_POST['title'])) ) {
//object
    $main=new main();
    $user=new user();
    $validate=new validation();
    $img=new image();
    $uid=$user->id();

$title=$validate->validate($_POST['title']);
$category=$validate->validate($_POST['category']);
$content=$validate->post_validate($_POST['content']);
$thumb_name=uniqid().".png";
$destination="../images/thumb/".$thumb_name;
$img->compress('thumb',$destination,20);

$status=$user->query("role");
if ($status=='author') {
  $status="published";
}elseif ($status=="admin") {
 $status="published";
}elseif ($status=="moderator") {
 $status="published";
}elseif ($status=="editor") {
 $status="published";
}
else {
  $status="pending";
}

$insert=$main->insert("INSERT INTO `content`( `uid`, `title`, `thumb`, `content`, `category`, `status`) VALUES (
'$uid','$title','$thumb_name','$content','$category','$status');");
if ($insert) {
  $submited="Submitted Your post";
} else {
  echo "<b>Error</b>";
}
}
?>

  <?php include('include/footer.php');?>
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function(){
    $('.textarea').summernote()
  })
</script>

