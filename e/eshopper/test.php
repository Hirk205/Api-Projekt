

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="file">
		<button type="submit" name ="upload">Upload</button>
	</form>	

	<?php
		include_once "storage.php";
		$storage = new storage();

		
		if(isset($_POST['upload'])){
			$storage->uploadObject('api-hlh-bucket-1',$_FILES['file']['name'],$_FILES['file']['tmp_name']	);
		}

	?>

</body>
</html>