<?php include_once("header.php") ?>



	
	<section id="advertisement">
		<div class="container">
			<img src="images/shop/advertisement.jpg" alt="" />
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						
					
						<div class="brands_products"><!--brands_products-->
							<h2>Danh mục sản phẩm</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									
									<?php include_once("php/loaisp.php"); ?>

								</ul>
							</div>
						</div><!--/brands_products-->
						
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
						
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						
						<?php include_once("php/sanpham/spPage.php");
						?>
						
						<ul class="pagination">
							<li ><a href="product.php?limit=9&&page=1">1</a></li>
							<li><a href="product.php?limit=9&&page=2">2</a></li>
							<li><a href="product.php?limit=9&&page=3">3</a></li>
							<li><a href="product.php?limit=9&&page=4">4</a></li>
							<li><a href="">Trang : <?php echo $_GET['page']?> </a></li>

						</ul>
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	
<?php include_once("footer.php"); ?>