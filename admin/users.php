<?php
require("include/header.php");
$main=new main();
$ip=new ip();
$validatin=new validation();
$main=new main();
if(isset($_POST['submit']) AND $_SERVER["REQUEST_METHOD"]=="POST"){
  $fname=$validatin->validate($_POST["name"]);
  $lname=$validatin->validate($_POST["lname"]);
  $email=$validatin->validate($_POST["email"]);
  $pass=htmlspecialchars($_POST["pass"]);
  $check=$main->select("select * from users where email='$email';");
  $checkmail=mysqli_num_rows($check);
if ($checkmail==0) {
//validation
        if(strlen($fname)>25 or strlen($fname)<2 or empty($fname)){
   $fnmsg="First Name must be between 2-20 character";
   $fname=$fname;
 } elseif(strlen($lname)>=20 or strlen($lname)<2 or empty($lname)){
  $lnmsg="Last Name must be between 2-20 character";
  $lname=$lname;
 } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
   $mlmsg="invalid mail";
   $email=$email;
 }else{
  $password=password_hash($pass, PASSWORD_DEFAULT);
  $auth=md5(sha1($email.$pass));
  $username=strstr($email, '@',TRUE);
  $ip=$_SERVER['REMOTE_ADDR'];
  $role=$_POST['role'];
  $insert=$main->insert("INSERT INTO users(name, lname, username, email, role,pass, auth,ip) VALUES ('$fname','$lname','$username','$email','$role','$password','$auth','$ip')");
  if ($insert) {
    echo "<b style='color:green;'>Successfully Added...</b>";
  } else {
    echo "error registration.";
  }
    

 }



} else {
   $trano=$email.' already registared.';
}



}
//user action

 if (isset($_GET['action']) and isset($_GET['uid'])) {
  $action_msg=$admin->action_user($_GET['uid'],$_GET['action']);
}

?>
<div class="row">
          <div class="col-12 col-md-12 badge">

            <?php if(isset($_GET['add_user'])){?>
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Add New User</h3>
              </div>
              <div class="card-body">
              <form action="" method="post">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>
                  <input type="text" name="name" class="form-control" placeholder="First Name">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>
                  <input type="text" name="lname" class="form-control" placeholder="Last Name">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                 <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                  </div>
                  <input type="text" name="pass" class="form-control" placeholder="password">
                </div>
                 <select name="role" id="role" class="form-control">   
                             <option value="author">Author</option>
                             <option value="subscriber">subscriber</option>
                             <option value="moderator">Moderator</option>
                             <option value="editor">editor</option>
                            </select>  
                <button class="btn btn-success" type="submit" name="submit" style="width:50%;">Submit</button>
               </form>
                <!-- /input-group -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          <?php } ?>
            <div class="card">
              <a href="?add_user"><button class="btn btn-success">Add User</button></a>
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>

                <div class="card-tools">
                	<form action="" method="post">
                  <div class="input-group input-group-sm" style="width: 200px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default btn-sm"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
              	<?php if(!isset($_POST['search'])){ ?>
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>IP</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php 
                      $query=$main->select("SELECT * FROM users  ORDER BY id desc LIMIT 100");
                      while ($users=$query->fetch_assoc()) {
                  	 ?>
                    <tr>
                      <td><?php echo $users['id'];?></td>
                      <td><?php echo $users['name']." ".$users['lname'];?></td>
                      <td><?php echo $users['email'];?></td>
                      <td><span class="tag tag-success"><?php echo $users['role'];?></span></td>
                      <td><?php echo $users['ip'];?></td>
                       <?php if($users['role']!='global admin'){ ?><td><a href="?uid=<?php echo $users['id'];?>&action=delete">Delete</a></td><?php } ?>
                    </tr>
              <?php } ?>  
                  </tbody>
                </table><?php }else{ ?>
                	
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>IP</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php
                  	  $search=$_POST['search'];
                      $query=$main->select("SELECT * FROM users WHERE `name` LIKE '%$search%' or `lname` LIKE '%$search%' or `email` LIKE '%$search%' or `username` LIKE '%$search%' or `role` LIKE '%$search%' ORDER BY id desc");
                      while ($users=$query->fetch_assoc()) {
                  	 ?>
                    <tr> 
                      <td><?php echo $users['id'];?></td>
                      <td><?php echo $users['name']." ".$users['lname'];?></td>
                      <td><?php echo $users['email'];?></td>
                      <td><span class="tag tag-success"><?php echo $users['role'];?></span></td>
                      <td><?php echo $users['ip'];?></td>
                      <?php if($users['role']!='global admin'){ ?><td><a href="?uid=<?php echo $users['id'];?>&action=delete">Delete</a></td><?php } ?>
                    </tr>
              <?php } ?>  
                  </tbody>
                </table><?php } ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        






<?php
require("include/footer.php");
?>