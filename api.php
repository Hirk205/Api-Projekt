<?php
require 'restful_api.php';
include_once("DataProvider.php");

class api extends restful_api {
    
    
	public function __construct(){
        parent::__construct();
       
	}
    public function sanphams(){
        $db=new DataProvider();
        include_once("sanphams.php");
    }
   
    public function loaisps(){
        
        $db=new DataProvider();
        include_once("loaisps.php");

    }
    
    public function users(){
        $db=new DataProvider();
        include_once("users.php");
        
    }

    public function hoadons(){
        $db= new DataProvider();
        include_once("hoadons.php");
       
    }

    public function chitiethoadons(){
        $db= new DataProvider();
        include_once("chitiethoadons.php");
       
    }
}

$api_connect = new api();
?>