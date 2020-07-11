<?php
require("include/header.php");

 $query=$_GET["q"];
 $main=new main();
 $format=new format();
 $result=$main->select("SELECT * FROM `content` WHERE status='published' and title LIKE '%$query%' order by title desc");
 $rows=mysqli_num_rows($result);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Search</title>
	<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="lib/style.css">
    <link rel="stylesheet" href="lib/fontawesome/css/all.css">
</head>
<body>
	 <?php 
 if ($rows>0) {
 	?>
 	<div class="container-fluid">
	<div class="row">
	 <!--left side start-->
	 <div class="col-md-6 d-block d-sm-block d-md-block">
        <div class="popular ">
           <form class="form-inline my-2 my-lg-0 " method="get" action="search.php">
    <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search" name="q">
      <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
    </form>
      <div class="list-group ">
 <?php 

 while ($post=$result->fetch_assoc()) {
         ?>
        <div class="p-post">
          <a href="article.php?id=<?php echo $post["id"]; ?>" class="list-group-item list-group-item-action">
          <img src="images/p3.jpg"/><?php echo $post["title"];?>
          <div class="post-info"><div class="row">
              <div class="col"><?php echo $format->views($post["views"]);?></div>
            </div>
            </div>
          </a>        
       </div>
<?php } ?>
     </div>
      </div>
	 </div><!--left  side end-->
  </div>
</div>
 	<?php
 } else {
 	echo "<center>Result Not Found<br><a href='index.php'>Home</a></center>";
 }
 include("include/footer.php");
?>
</body>
</html>