<?php

/**
 * user class
 */
class user extends main{

public function check_usr(){
if(isset($_COOKIE['c_user'])) {
   $auth= $_COOKIE['c_user'];
   $query=parent::select("select * from users where auth='$auth'");
   $check=mysqli_num_rows($query);
   if($check==1){return true;}else{return false;}  } 
}


public function id(){
 if (isset($_COOKIE['c_user'])){
   $auth= $_COOKIE['c_user'];
   $query=parent::select("select * from users where auth='$auth'");
   $check=mysqli_num_rows($query);
   $row=$query->fetch_assoc();
   if($check==1){return $row['id'];
   }else{return false;}  }else{
   	return false;
   }
}

public function query($row){
	$id=$this->id();
	$query=parent::select("select * from users where id='$id'");
	$result=$query->fetch_assoc();
	return $result[$row];
}

public function add_view($postid){
   $views_q=parent::db_query("content","id","$postid");
   $curent_views=$views_q['views'];
   $new_v=$curent_views+1;
   $query=parent::update("update content set views='$new_v' where id='$postid'");
if ($query) {
   return true;
} else {
   return false;
}

}








}
?>