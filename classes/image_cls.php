<?php
  /**
   * image class
   */
  class image extends main
  {
  	

protected  function compress_image($tmpfile, $destination_url, $qualitysize)
    {
        $info = getimagesize($tmpfile);
        if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($tmpfile);
        elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($tmpfile);
        elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($tmpfile);
        imagejpeg($image, $destination_url, $qualitysize);
        return true;
    }


 public function compress($name,$destination,$quality){
    $file_name = $_FILES["$name"]["name"];
    $file_type = $_FILES["$name"]["type"];
    $temp_name = $_FILES["$name"]["tmp_name"];
    $file_size = $_FILES["$name"]["size"];
    $error = $_FILES["$name"]["error"];
    if (!$temp_name)
    {
        return false;
        exit();
    }

    if ($error > 0)
    {
        echo $error;
    }
    else if (($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
    {
        return  $this->compress_image($temp_name, $destination, $quality);
    }
    else
    {
        return  "Uploaded image should be jpg or gif or png.";
    }

 }



  }
    
 ?>