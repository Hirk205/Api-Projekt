<?php
	session_start();
	if(isset($_POST['login'])){
		if(!$_POST['username'] && !$_POST['password']){
			include_once("call_api.php");
			$get_data = callAPI('GET', 'http://35.219.60.232/api.php/users?action=login', false);
		     $data= json_decode($get_data, true);
		}
	}
?>