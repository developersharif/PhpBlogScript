<?php
class url extends main{  
    public $protocol;
    public $domain;
    public $dirname;

    public function __construct(){
        $protocol= (isset($_SERVER["HTTPS"])) ? "https://" : "http://" ;
        $domain= $_SERVER['SERVER_NAME'];
        $dirname= dirname($_SERVER["REQUEST_URI"]);
        $this->protocol=$protocol;
        $this->domain=$domain;
        $this->dirname=$dirname;

    }
	public  function base_url(){
		$protocol = (isset($_SERVER["HTTPS"])) ? "https://" : "http://" ;
		$domain= $_SERVER['SERVER_NAME'];
		$dirname=  dirname($_SERVER["REQUEST_URI"]);
		return $protocol.$domain.$dirname;
    }



    
    
    
}





?>