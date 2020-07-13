<?php

/**
 * 
 */
class admin extends main
{

 public function action_post($action,$post_id){
 
 if (isset($post_id) and isset($action)) {
 	if ($action=="publish") {
 	$update=parent::update("update content set status='published' where id='$post_id'");	
 	if ($update) {
 		return "published";
 	} else {return false;}
 	
 	} elseif($action=="pending"){
 	 $update=parent::update("update content set status='pending' where id='$post_id'");	
 	if ($update) {
 		return "Curent status pending";
 	} else {return false;}
 		
 	}elseif($action=="ban"){
 		$update=parent::update("update content set status='banned' where id='$post_id'");	
 	if ($update) {
 		return "Status banned";
 	} else {return false;}
 	}elseif($action=="delete"){ 
 	   $query=parent::db_query("content","id","$post_id");
 	   $thumb=$query['thumb'];
 	   unlink("../images/thumb/".$thumb);
 	   $delete=parent::delete("delete from content where id='$post_id'"); 
 	   if ($delete) {
 	   	return "Post deleted";
 	   } else{ return false;}
 	}else{
 		return FALSE;
 	}

 }else{
 	return false;
 }


}//function end	

public function action_user($user_id,$action){
  
if (isset($user_id) and isset($action)) {

if ($action=='author') {
	$update=parent::update("update users set role='author' where id='$user_id'");	
 	if ($update) {
 		return "success";
 	} else {return false;}
} elseif($action=="subscriber"){
	$update=parent::update("update users set role='subscriber' where id='$user_id'");	
 	if ($update) {
 		return "success";
 	} else {return false;}
}elseif ($action=="editor") {
	$update=parent::update("update users set role='editor' where id='$user_id'");	
 	if ($update) {
 		return "success";
 	} else {return false;}
}elseif ($action=="moderator") {
	$update=parent::update("update users set role='moderator' where id='$user_id'");
 	if ($update) {
 		return "success";
 	} else {return false;}
}elseif ($action=="ban") {
	$update=parent::update("update users set role='ban' where id='$user_id'");	
 	if ($update) {
 		return "success";
 	} else {return false;}
}elseif ($action=="madmin") {
	$delete=parent::delete("delete from admin where uid='$user_id'"); 
	$update=parent::update("update users set role='author' where id='$user_id'");	
 	if ($update) {
 		return "Admin Removed";
 	} else {return false;}
}elseif ($action=="admin") {
	//$insert=parent::insert("INSERT INTO `admin`(`uid`, `role`) VALUES ('$user_id','$action')");
	$update=parent::update("update users set role='admin' where id='$user_id'");	
 	if ($update) {
 		return "New Admin Added";
 	} else {return false;}
}elseif ($action=="rmod") {
	//$delete=parent::delete("delete from admin where uid='$user_id' and role='moderator'"); 
	$update=parent::update("update users set role='author' where id='$user_id'");	
 	if ($update) {
 		return "moderator Removed";
 	} else {return false;}
}elseif ($action=="delete") {
	$delete=parent::delete("delete from admin where uid='$user_id'"); 
	$delete=parent::delete("delete from users where id='$user_id'"); 
	
 	if ($delete) {
 		return " Removed";
 	} else {return false;}
}


}else{
	return false;
}

}//function end

public function admin_check($auth){
 $query=parent::select("SELECT * FROM users WHERE auth='$auth' and role='global admin'");
 if (mysqli_num_rows($query)==1) {
 	return true;
 } else {
 	return false;
 }
 

}//function end


public function admin_tbl($role){

  $admin=parent::num_rows("SELECT * FROM users where role='admin'");
  $moderator=parent::num_rows("SELECT * FROM users where role='moderator'");
  $editor=parent::num_rows("SELECT * FROM users where role='editor'");
  $banned=parent::num_rows("SELECT * FROM users where role='ban'");
if ($role=='admin') {
	return $admin;
} elseif($role=='moderator') {
	return $moderator;
}elseif($role=='editor'){
   return $editor;
}elseif ($role=='banned') {
	return $banned;
}



}




















}//class end





?>