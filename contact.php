<?php require("include/header.php");
if ($settings['site_status'] === 'on') {
   $main = new main();
   $user_cls = new user();
   $valid = new validation();
   $ip_cls = new ip();
   if (isset($_POST['submit'])) {
      $title = $valid->validate($_POST['title']);
      $message = $valid->validate($_POST['message']);
      if ($user_cls->check_usr() == false) {
         $email = $_POST["email"];
      } else {
         $email = $user_cls->query("email");
      }
      $ip = $ip_cls->get_ip();
      $insert = $main->insert("insert into contact (title,message,email,ip) values('$title','$message','$email','$ip')");
      if ($insert) {
         header("location: contact.php?s=success");
         exit();
      } else {
         header("location: contact.php?s=error");
         exit();
      }
   }
?>
<title>Contact</title>
<?php if (isset($_GET['s'])) { ?> <center>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $_GET['s']; ?></div>
</center><?php } ?>
<div class="card contact">
    <div class="card-body">
        <form action="" method="post">
            <label for="title">
                <h6>Title</h6>
            </label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Title" required>

            <label for="message">
                <h6>Message</h6>
            </label>
            <textarea name="message" placeholder="Write your message" class="form-control" id="message"
                required></textarea>
            <?php if ($user_cls->check_usr() == false) { ?>
            <label for="email">
                <h6>Email</h6>
            </label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" style="color:black"
                required></input><?php } ?>
            <input type="submit" value="Submit" class="btn btn-primary" name="submit"></input>
        </form>
    </div>
</div>
<?php include("include/footer.php");
} ?>