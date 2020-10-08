<?php
	if(isset($_GET['q'])){
		include_once("call_api.php");

		$get_data = callAPI('GET', 'http://35.219.60.232/api.php/sanphams?q='.$_GET['q'], false);
	     $data= json_decode($get_data, true);
	}
?>