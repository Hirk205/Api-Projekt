<?php
	include_once ("php/call_api.php");

	$get_data = callAPI('GET', 'http://35.219.60.232/api.php/sanphams?limit=6&&page=1', false);
     $data= json_decode($get_data, true);
     foreach($data as $item){
     	@$gia = number_format($item[dongia]);
	echo "<div class='col-sm-4'>";
		echo "<div class='product-image-wrapper'>";
			echo "<div class='single-products'>";
					echo "<div class='productinfo text-center'>";
						echo "<img src='$item[hinhanh]' alt='' />";
						echo "<h2>$gia đ</h2>";
						echo "<p>$item[tensp]</p>";
						echo "<a href='#' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a>";
					echo "</div>";
					echo "<div class='product-overlay'>";
						echo "<div class='overlay-content'>";
							echo "<h1>$item[tensp]<h1>";
							echo "<a href='product-details.php?idsp=$item[idsanpham]' class='btn btn-default'><i class='fa '></i>Chi tiết</a>";
							echo "<p>Thương hiệu: <i>$item[thuonghieu]</i></p>";
							echo "<h2>$gia đ</h2>";
							echo "<p>Màu: $item[mau] Size: $item[size]</p>";
							echo "<a href='#' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a>";
						echo "</div>";
					echo "</div>";
			echo "</div>";
			
		echo "</div>";
	echo "</div>";
	}
?>
