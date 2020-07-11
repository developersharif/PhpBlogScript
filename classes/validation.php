<?php
/**
 *validation class 
 */
class validation
{
public function validate($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}	

public function post_validate($data){
  $data = trim($data);
  $data = stripslashes($data);
  return $data;
}	
	
	
}








?>