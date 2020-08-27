<?php require_once('include/header.php');
if ($settings['site_status'] === 'on') {
  $main = new main();
  $format = new format();
  $check_post = $main->num_rows("select * from content");
  $perpage = $settings['perpage_post'];
  if (isset($_GET["p"])) {
    $page = htmlspecialchars(intval($_GET["p"]));
  } else {
    $page = 1;
  }
  $calc = $perpage * $page;
  $start = $calc - $perpage;
  $result = $main->select("SELECT content.id,content.uid,content.title,content.thumb,content.category,content.date, content.status,content.views, users.name FROM content INNER JOIN users ON content.uid=users.id and content.status='published' ORDER BY id DESC limit $start, $perpage");
?>
<title>Home-<?php echo $settings['site_title']; ?></title>
<!-- Primary Meta Tags -->
<meta name="title" content="<?php echo $settings['site_title']; ?>">
<meta name="description" content="<?php echo $settings['site_description']; ?>">

<!-- Facebook -->
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo $settings['site_description']; ?>">
<meta property="og:image" content="images/assets/bannar.png">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:title" content="<?php echo $settings['site_title']; ?>">
<meta property="twitter:description" content="<?php echo $settings['site_description']; ?>">
<meta property="twitter:image" content="images/assets/bannar.png">
<div class="container-fluid">
    <?php if ($settings['notice'] != '') { ?><div class="noticeboard">
        <p class="notice-t">Noticce:</p>
        <marquee><?php
                  echo $settings['notice'];
                  ?></marquee>
    </div><?php } ?>
    <div class="row">
        <div class="col-md-8">

            <!--post start-->
            <?php if (!isset($_GET['category'])) { ?>
            <div class="row">
                <?php
            while ($post = $result->fetch_assoc()) {
            ?>
                <div class="col-md-4 col-sm-6">
                    <?php if ($check_post != false) { ?>
                    <div class="card post-card"><a href="article.php?id=<?php echo $post["id"]; ?>">
                            <img class="card-img-top" src="images/thumb/<?php echo $post['thumb']; ?>"
                                alt="<?php echo $post['title']; ?>">
                            <div class="categories"><?php echo $post["category"]; ?></div>
                            <div class="card-body">
                                <p class="card-title"><?php echo $post["title"]; ?></p>
                        </a>
                        <div class="post-info">
                            <div class="row">
                                <div class="col small"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                    <?php echo $post["name"]; ?></div>
                                <div class="col small"><i class="fa fa-eye" aria-hidden="true"></i>
                                    <?php echo  $format->views($post["views"]); ?></div>
                                <div class="col small"><i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php $date = date_create($post["date"]);
                          echo date_format($date, "M/d/y "); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php
            }

        ?>
        </div>
        <!--post end-->
        <?php } elseif (isset($_GET['category']) and $_GET['category'] != "") { ?>
        <div class="row">
            <?php
          $category = $_GET['category'];
          $num_rows = $main->num_rows("select * from content where status='published' and category='$category'");
          if ($num_rows > 0) {
            $result = $main->select("SELECT content.id,content.uid,content.title,content.thumb,content.category,content.date, content.status,content.views, users.name FROM content INNER JOIN users ON content.uid=users.id and content.status='published' and content.category='$category' ORDER BY id DESC limit $start, $perpage");
            while ($post = $result->fetch_assoc()) {
        ?>
            <div class="col-md-6 ">
                <div class="card post-card"><a href="article.php?id=<?php echo $post["id"]; ?>">
                        <img class="card-img-top" src="images/thumb/<?php echo $post['thumb']; ?>" alt="Card image">
                        <div class="categories"><?php echo $post["category"]; ?></div>
                        <div class="card-body">
                            <p class="card-title"><?php echo $post["title"]; ?></p>
                    </a>
                    <div class="post-info">
                        <div class="row">
                            <div class="col"><?php echo $post["name"]; ?></div>
                            <div class="col">views <?php echo  $format->views($post["views"]); ?></div>
                            <div class="col"><?php echo $format->time_ago($post["date"]); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <?php }
          } ?>
    </div>
    <?php   }
        if (!isset($_GET['category'])) { ?>
    <div class="row">
        <!--pagination-->
        <div class="col">
            <ul class="pagination">
                <?php
          if ($check_post != false) {
            if (isset($page)) {
              $result = $main->select("SELECT * FROM content where status='published'");;
              $rows = mysqli_num_rows($result);
              if ($rows) {
                $total = $rows;
              }
              $totalPages = ceil($total / $perpage);
              if ($page <= 1) {
                //echo "<span id='page_links' style='font-weight: bold;'>Prev</span>";
              } else {
                $j = $page - 1;
                //echo "<span><a id='page_a_link' href='?p=$j'>< Prev</a></span>";
                echo "<li class='page-item'><a class='page-link' href='?p=$j'>Previous</a></li>";
              }
              for ($i = 1; $i <= $totalPages; $i++) {
                if ($i <> $page) {
                  //echo "<li class='page-item'><a class='page-link' href='?p=$i'>$i</a></li>";
                } else {
                  echo "<li class='page-item page-link'  style='font-weight: bold;background-color: #757575;color: white;border-radius: 12px;font-size: 18px;'>$i</li>";
                }
              }
              if ($page == $totalPages) {
                //echo "<span id='page_links' style='font-weight: bold;'>Next ></span>";
              } else {
                $j = $page + 1;
                echo "<li class='page-item'><a class='page-link' href='?p=$j'>Next</a></li>";
              }
            }
          } //end chek post
          ?>
            </ul>
        </div>
    </div>
    <!--pagination-->
    <?php } elseif (isset($_GET['category']) and $_GET['category'] != "" and  $num_rows > $perpage) { ?>

    <div class="row">
        <!--pagination-->
        <div class="col">
            <ul class="pagination">
                <?php
          if (isset($page)) {
            $result = $main->select("SELECT * FROM content where status='published' and category='$category'");;
            $rows = mysqli_num_rows($result);
            if ($rows) {
              $total = $rows;
            }
            $totalPages = ceil($total / $perpage);
            if ($page <= 1) {
              //echo "<span id='page_links' style='font-weight: bold;'>Prev</span>";
            } else {
              $j = $page - 1;
              //echo "<span><a id='page_a_link' href='?p=$j'>< Prev</a></span>";
              echo "<li class='page-item'><a class='page-link' href='?category=$category&p=$j'>Previous</a></li>";
            }
            for ($i = 1; $i <= $totalPages; $i++) {
              if ($i <> $page) {
                //echo "<li class='page-item'><a class='page-link' href='?p=$i'>$i</a></li>";
              } else {
                echo "<li class='page-item page-link'  style='font-weight: bold;background-color: #757575;color: white;border-radius: 12px;font-size: 18px;'>$i</li>";
              }
            }
            if ($page == $totalPages) {
              //echo "<span id='page_links' style='font-weight: bold;'>Next ></span>";
            } else {
              $j = $page + 1;
              echo "<li class='page-item'><a class='page-link' href='?category=$category&p=$j'>Next</a></li>";
            }
          }

          ?>
            </ul>
        </div>
    </div>
    <!--pagination-->

    <?php }

  ?>
</div>
<div class="col-md-4 col-lg-4 d-none d-sm-none d-md-block">
    <form class="form-inline my-2 my-lg-0 " method="get" action="search.php">
        <input class="form-control mr-sm-2 " type="search" placeholder="Search" aria-label="Search" name="q">
        <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
    </form>
    <div class="popular ">
        <div class="border-left ">Popular</div>
        <div class="list-group ">
            <?php
        $result = $main->select("SELECT content.id,content.uid,content.title,content.thumb,content.category,content.date, content.status,content.views, users.name FROM content INNER JOIN users ON content.uid=users.id and content.status='published'  order by views DESC LIMIT 6");
        while ($post = $result->fetch_assoc()) {

        ?>
            <div class="p-post">
                <a href="article.php?id=<?php echo $post["id"]; ?>" class="list-group-item list-group-item-action">
                    <img src="images/thumb/<?php echo $post['thumb']; ?>" /><?php echo $post["title"]; ?>
                    <div class="post-info">
                        <div class="row">
                            <div class="col small"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                <?php echo $post["name"]; ?></div>
                            <div class="col small"><i class="fa fa-eye" aria-hidden="true"></i>
                                <?php echo $format->views($post["views"]); ?></div>
                            <div class="col small"><i class="fa fa-calendar" aria-hidden="true"></i>
                                <?php echo $format->time_ago($post["date"]); ?></div>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>

        </div>
    </div>

    <br>
    <div class="border-left">Categories</div>
    <div class="list-group ">
        <?php
      $result = $main->select("SELECT content.category,COUNT(*) AS total FROM content WHERE status='published' GROUP by content.category  ORDER BY category ");
      while ($cate = $result->fetch_assoc()) {

      ?>
        <a href="?category=<?php echo $cate["category"]; ?>" class="list-group-item list-group-item-action"><span
                class="small"><i class="fa fa-hashtag" aria-hidden="true"></i>
            </span><?php echo $cate["category"]; ?><span class="badge"><?php echo $cate["total"]; ?></span></a>
        <?php } ?>
    </div>
</div>
</div>
</div>
<?php include('include/footer.php'); ?>
</body>

</html>
<?php } else { ?>
<center>
    <h3>Under Maintenance</h3>
</center>
<?php } ?>