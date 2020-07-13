<?php
require("include/header.php");
if($settings['site_status']==='on'){
$main=new main();
$user=new user();
       $format=new format();
       $postid=$_GET['id'];
       $result=$main->select("SELECT content.id,content.uid,content.title,content.thumb,content.content,content.category,content.date, content.status,content.views, users.name,users.bio FROM content INNER JOIN users ON content.uid=users.id and content.status='published' ORDER BY id desc LIMIT 10");
       $user->add_view($postid);
?>
<div class="container-fluid">
	<div class="row">
	 <!--left side start-->
	 <div class="col-md-3 d-none d-sm-none d-md-block">
            <div class="popular ">
        <div class="border-left ">Recent</div>
      <div class="list-group ">
 <?php while ($post=$result->fetch_assoc()) {
         ?>
        <div class="p-post">
          <a href="article.php?id=<?php echo $post["id"]; ?>" class="list-group-item list-group-item-action" style="overflow: hidden;">
          <img src="images/thumb/<?php echo $post['thumb']; ?>"/><?php echo $post["title"];?>
          <div class="post-info"><div class="row">
              <div class="col"><?php echo $post["name"];?></div>
              <div class="col"><?php echo $format->views($post["views"]);?></div>
               <div class="col"><?php echo $format->time_ago($post["date"]);?></div>
            </div>
            </div>
          </a>        
       </div>
<?php } ?>
     </div>
      </div>
	 </div><!--left  side end-->
	 <!--middle side start-->
	 <div class="col-md-6">
<?php 
$result=$main->select("SELECT content.id,content.uid,content.title,content.thumb,content.content,content.category,content.date, content.status,content.views, users.name,users.lname,users.bio,users.role,users.avatar FROM content INNER JOIN users ON content.id=$postid and content.status='published' and content.uid=users.id");
  $post=$result->fetch_assoc(); 
?>
<title><?php echo $post['title'];?></title>
	<div class="row">
		<div class="col">
          <div class="card post-card"> 
                <div class="card-body">
                 <p class="title"><?php echo $post['title'];?></p>
                  <p class="p-date"><?php 
                  $date=strtotime($post['date']);
                  echo $post['category']." . ".date("d-M-Y", $date);

                  ?></p> 
                	<hr>
               <?php 
                echo $post["content"];

               ?>
               <br>
               <div class="date"><?php echo $format->time_ago($post["date"]);?></div>
            </div>
          </div>	
		</div>
	</div>

  <div class="row">
  	<div class="col">
  		<div class="card author-info">
  		   <div class="list-group">
           <li class="list-group-item"><table><tr><td><img src="images/profile/<?php echo $post['avatar']; ?>" alt="" class="avatar"></td><td><span><b><?php echo $post["name"]." ".$post["lname"];?></b></span> <br><?php echo $post["role"];?></td> </tr></table></li>
           <li class="list-group-item"><b>About:</b><span ><?php echo $post["bio"];?></span></li>
          </div>
  		</div>
  	</div>
  </div>
  <div class="row">
  	<div class="col">
  		<div class="card comments">
      <div id="disqus_thread"></div>
  		</div>
  	</div>
  </div>
  
	</div><!--middle side end-->

	 <!--right side start-->
	 <div class="col-md-3">

<form class="form-inline my-2 my-lg-0 " action="search.php">
      <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search" name="q">
      <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
    </form>
      <div class="popular ">
        <div class="border-left ">Related</div>
      <div class="list-group ">
<?php
       $post_info=$main->db_query("content","id","$postid");
       $post_cate=$post_info['category'];
       $post_title=$post_info['title'];
       $result=$main->select("SELECT content.id,content.uid,content.title,content.thumb,content.category,content.date, content.status,content.views, users.name FROM content INNER JOIN  users ON content.uid=users.id and content.status='published' and content.category='$post_cate' and content.id!='$postid' or content.title LIKE '%$post_title%'  order by id LIMIT 5");
       while ($post=$result->fetch_assoc()) {
       
        ?>
        <div class="p-post" style="overflow: hidden;"> 
        <a href="article.php?id=<?php echo $post["id"]; ?>">
          <img src="images/thumb/<?php echo $post['thumb']; ?>"/><?php echo $post["title"];?></a>
          <div class="post-info"><div class="row">
              <div class="col"><?php echo $post["name"];?></div>
              <div class="col">views <?php echo $format->views($post["views"]);?></div>
              <div class="col"><?php echo $post["category"];?></div>
            </div>
            </div>      
       </div>
<?php } ?>

     </div>
      </div>

      <div class="popular ">
        <div class="border-left ">Popular</div>
      <div class="list-group ">
<?php

       $result=$main->select("SELECT content.id,content.uid,content.title,content.thumb,content.category,content.date, content.status,content.views, users.name FROM content INNER JOIN users ON content.uid=users.id and content.status='published' order by views DESC LIMIT 6");
       while ($post=$result->fetch_assoc()) {
  

        ?>
        <div class="p-post" style="overflow: hidden;">
        <a href="article.php?id=<?php echo $post["id"]; ?>">
          <img src="images/thumb/<?php echo $post['thumb']; ?>"/><?php echo $post["title"];?></a>
          <div class="post-info"><div class="row">
              <div class="col"><?php echo $post["name"];?></div>
              <div class="col">views <?php echo $format->views($post["views"]);?></div>
              <div class="col"><?php echo $post["category"];?></div>
            </div>
            </div>       
       </div>
<?php } ?>

    
     </div>
      </div>

	</div><!--right side start-->
	</div><!--row end-->
</div>
<script>
  (function () {
  var d = document, s = d.createElement('script');
  s.src = 'https://developersharif.disqus.com/embed.js';
  s.setAttribute('data-timestamp', +new Date());
  (d.head || d.body).appendChild(s);
})();
</script>
<script id="dsq-count-scr" src="//developersharif.disqus.com/count.js" async></script>
<?php include('include/footer.php');?>
</body>
</html>
<?php }else{?>
  <center><h3>Under Maintenance</h3></center>
  <?php } ?>