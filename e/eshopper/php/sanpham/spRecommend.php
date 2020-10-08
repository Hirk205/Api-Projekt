<?php
	include_once("php/call_api.php");

	$get_data = callAPI('GET', 'http://35.219.60.232/api.php/sanphams?limit=15&&page=1', false);
     $data= json_decode($get_data, true);
     $i=1;
     foreach($data as $item){


		
		@$gia = number_format($item[dongia]);
		$chuoi = <<< EOD
			<div class="col-sm-4">
				<a href ="product-details.php?idsp=$item[idsanpham]">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<img src="$item[hinhanh]" alt="" />
							<h2>$gia</h2>
							<p>$item[tensp]</p>
							<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giở hàng</button>
						</div>
					</div>
				</div>
				</a>
			</div>
EOD;
		echo $chuoi;

		if($i == 15){
			echo "</div>";
			break;
		}
		else{
			if($i %3 == 0){
				echo "</div>";
				echo 	"<div class=item>";
			}
		}
		
		$i++;
	}
?>
