<?php
	include_once("call_api.php");

	$get_data = callAPI('GET', 'http://35.219.60.232/api.php/loaisps', false);
     $data= json_decode($get_data, true);
     $i=1;
     foreach($data as $item){
		echo "<li><a href='product-category.php?idloai=$i'> <span class='pull-right'></span>$item[tenloai]</a></li>";
		$i++;
	}
?>