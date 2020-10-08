<?php include_once("header.php");  ?>

<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập</h2>
						<form action="#" method="GET">
							<input type="text" name="username" placeholder="Username" />
							<input type="password" name="password" placeholder="Password" />
							
							<button type="submit" name='login' class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="#" method="POST">
							<input type="text" placeholder="usernam"/>
							<input type="password" placeholder="Password"/>
							<input type="text" name="" placeholder="số điện thoại">
							<input type="text" name="" placeholder="Địa chỉ">
							<input type="text" name="" placeholder="ngày sinh">
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->


<?php include_once ("footer.php") ?>
