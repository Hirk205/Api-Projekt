<?php
	include_once("php/call_api.php");
	if(isset($_GET['idsp'])){
		@$url = "http://35.219.60.232/api.php/sanphams/" . $_GET[idsp];
			$get_data = callAPI('GET', $url, false);
	     $data= json_decode($get_data, true);
		@$gia = number_format($data[dongia]);
	     	$chuoi = <<<EDO
	     	<div class="col-sm-5">
							<div class="view-product">
								<img src= $data[hinhanh] alt="" />
								
							</div>
						
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<h1>$data[tensp]</h1>
								<h2></h2>
								<p>Web ID: 1089772</p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span>$gia đ</span>
									<label></label>
									
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Thêm vào giỏ hàng
									</button>
								</span>
								<p><b>Màu săc: </b>$data[mau]</p>
								<p><b>Size: </b>$data[size]</p>
								<p><b>Thương hiệu:</b> $data[thuonghieu]</p>
								<div> $data[mota] </div>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>

							</div><!--/product-information-->
						</div>
EDO;	
			echo $chuoi;

	}
	
?>