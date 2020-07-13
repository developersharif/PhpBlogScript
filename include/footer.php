<section class="footer bg-black">
              <div class="container-fluid">
               <div class="row">
                 <div class="col-md-6 col-6">
                   <div class="list-group">
                     <a href="index.php">Home</a>              
                     <a href="">About us</a>              
                     <a href="">tearms</a>             
                     <a href="">privacy policy</a>
                   </div>
                 </div>
                 <div class="col-md-6 col-6">
                      <div class="list-group">               
                     <a href="contact">Contact us</a>
                    <?php if(isset($_COOKIE['c_user'])){ ?> <a href="logout.php">Logout</a><?php } ?>
                 </div>
               </div>
               <div class="col">
                &nbsp;
                  <div class="align-center small">&copy; <?php echo date('Y'); ?> by <?php echo $settings['site_name']; ?> All Rights Reserved.</div> 
               </div>
              </div>
             </section>
             <?php if($settings['dark_mode']=="on"){ ?>
<script type="text/javascript" charset="utf-8">
$(".dark-mode").ready(function(){$("body,input,textarea,select,option,a,button,div,nav,code,p,li,h1,h2,h3,h4").addClass("dark-mode");});
</script>
<?php } ?>
<!--javascript -->
<script src="lib/function.js" type="text/javascript"></script>
<script src="lib/jquery.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
