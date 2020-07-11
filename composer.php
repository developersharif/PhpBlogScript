<?php
require("include/header.php");
if($settings['site_status']==='on'){

 
if($settings['new_post']==='on'){

   if (isset($_POST["submit"]) and !empty(trim($_POST['content'])) and $_SERVER['REQUEST_METHOD'] == "POST" and !empty(trim($_POST['title'])) ) {
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
$destination="images/thumb/".$thumb_name;
$img->compress('thumb',$destination,20);

$status=$user->query("role");
if ($status=='author') {
  $status="published";
}elseif ($status=="admin" or $status=='global admin') {
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

  <title>New Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="lib/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="lib/dist/editor/dist/ui/trumbowyg.min.css">
<link rel="stylesheet" href="lib/dist/editor/dist/plugins/colors/ui/trumbowyg.colors.css">
<link rel="stylesheet" href="lib/dist/editor/dist/plugins/emoji/ui/trumbowyg.emoji.css">
<link rel="stylesheet" href="lib/dist/editor/dist/plugins/table/ui/trumbowyg.table.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <style>
    .trumbowyg-editor table td {
    border: 1px solid #747474;
    padding: 5px;
  </style>
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
                              $select=$main->select("select category from categories where role='user' order by category;");
                              while ($cate=$select->fetch_assoc()){
                              ?>
                             <option value="<?php echo $cate['category']; ?>"><?php echo $cate['category']; ?></option>
                             <?php }?>
                            </select>  
                          </div>
                      </div>
              <div class="mb-3">
                <label for="content"><h6>Content</h6></label>
                 <textarea class="textarea content" id="editor" placeholder="Place some text here" name="content" 
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" value='<?php echo $post["content"]; ?>' value="shariful islam" required></textarea>
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
              <?php 
               }else{
                echo "<center>New Post Disabled</center>";
               }
              include('include/footer.php');?>
  <!-- jQuery -->
<script src="lib/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="lib/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="lib/dist/editor/dist/trumbowyg.min.js"></script>
<script src="lib/dist/editor/dist/plugins/colors/trumbowyg.colors.js"></script>
<script src="lib/dist/editor/dist/plugins/base64/trumbowyg.base64.js"></script>
<script src="lib/dist/editor/dist/plugins/emoji/trumbowyg.emoji.js"></script>
<script src="lib/dist/editor/dist/plugins/resizimg/trumbowyg.resizimg.js"></script>
<script src="lib/dist/editor/dist/plugins/resizimg/resizable-resolveconflict.min.js"></script>
<script src="lib/dist/editor/dist/plugins/table/trumbowyg.table.js"></script>
<script type="text/javascript" charset="utf-8" >
$('#editor').trumbowyg();
</script>
</body>
</html>
<?php }else{?>
  <center><h3>Under Maintenance</h3></center>
  <?php } ?>