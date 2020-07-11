<?php include('include/header.php');
$main=new main();
if (isset($_POST['submit']) and $_SERVER['REQUEST_METHOD']=='POST' and !isset($_GET['status'])) {
  $category=$_POST['category'];
  $role=$_POST['role'];
 $insert=$main->insert("INSERT INTO categories (category,role) values('$category','$role')");
 if ($insert) {
   echo "New caategory added";
 } else {
  echo "error-";
 }
 
} elseif (isset($_GET['status']) and $_SERVER['REQUEST_METHOD']=='POST') {
  $category=$_POST['category'];
  $role=$_POST['role'];
  $cat_id=$_GET['id'];
 $update=$main->update("UPDATE categories set category='$category',role='$role' where id='$cat_id'");
 if ($update) {
   echo "Updated category Name";
 } else {
  echo "error";
 }
}elseif (isset($_GET['status']) and $_GET['status']=='delete' ) {
  $cat_id=$_GET['id'];
 $delete=$main->delete("DELETE FROM categories where id='$cat_id'");
 if ($delete) {
   echo "Category Deleted";
 } else {
   echo "error";
 }
 
}
?>
<div class="container-fluid">
  <div class="row">
           <div class="from-controll">
         <form action="" method="post">
           <input type="text" name="category" placeholder="Category Name" value="<?php if(isset($_GET['category'])){ echo 
            $_GET['category']; } ?>"><select name="role"><option value="user">user</option><option value="admin">admin</option></select> <input type="submit" name="submit" value="Add" class="btn btn-success btn-sm"><a href="categories.php"> Refresh</a>
         </form> 
       </div>
    <div class="col-12 col-sm-12 col-md-10">
                 <div class="card">
              <div class="card-header">
                <h3 class="card-title">Categories Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">id</th>
                      <th>Category</th>
                      <th style="text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
      <?php
$result=$main->select("SELECT * from categories ORDER BY id desc;");
while ($cate=$result->fetch_assoc()) {

      ?>

                    <tr>
                      <td><?php echo $cate["id"];?></td>
                      <td><?php echo $cate["category"];?></td>
                      <td>
                        
                          <span class="badge bg-primary"><a href="?category=<?php echo $cate['category']; ?>&id=<?php echo $cate['id'];?>&status=update">Edit</a></span>
                        
                      </td>
                      <td><span class="badge bg-danger"><a href="?id=<?php echo $cate['id'];?>&status=delete">Delete</a></span></td>
                    </tr>
                   
  
    <?php } ?>
                </tbody>
                </table>
              </div>
              <!-- /.card-body -->
     </div>
    </div>
  </div>
</div>










<?php include("include/footer.php");?>