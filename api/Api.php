<?php

//Api.php

class API
{
	private $connect = '';

	function __construct()
	{
		$this->database_connection();
	}

	function database_connection()
	{
		$this->connect = new PDO("mysql:host=localhost;dbname=quanlyquanao", "root", "");
	}

	function fetch_all($query)
	{
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			while($row = $statement->fetch(PDO::FETCH_ASSOC))
			{
				$data[] = $row;
			}
			return $data;
		}
	}

	function insert()
	{
		if(isset($_POST["idsanpham"]))
		{
			if(isset($_FILES['image'])){
				$errors= array();
				$file_name = $_FILES['image']['name'];
				$file_size = $_FILES['image']['size'];
				$file_tmp = $_FILES['image']['tmp_name'];
				$file_type = $_FILES['image']['type'];
				$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
				 
				$expensions= array("jpeg","jpg","png");
				 
				if(in_array($file_ext,$expensions)=== false){
				   $errors[]="Chỉ hỗ trợ upload file JPEG hoặc PNG.";
				}
				 
				if($file_size > 2097152) {
				   $errors[]='Kích thước file không được lớn hơn 2MB';
				}
				 
				if(empty($errors)==true) {
					move_uploaded_file($_FILES["file"]["tmp_name"], "image/" . $_FILES["file"]["name"]);
					$filelocation = 'http://localhost:8012/api-projekt/image/'.$_FILES["file"]["name"];
					$form_data = array(
						':idsanpham'		=>	$_POST["idsanpham"],
						':loaisp'		=>	$_POST["loaisp"],
						':tensp'		=>	$_POST["tensp"],
						':mau'		=>	$_POST["mau"],
						':size'		=>	$_POST["size"],
						':thuonghieu'		=>	$_POST["thuonghieu"],
						':giagoc'		=>	$_POST["giagoc"],
						':dongia'		=>	$_POST["dongia"],
						':mota'		=>	$_POST["mota"],
					);
					$query = "
					INSERT INTO `sanpham` (`idsanpham`, `loaisp`, `tensp`, `mau`, `size`, `thuonghieu`, `giagoc`, `dongia`, `mota`, `hinhanh`) 
					VALUES (`:idsanpham`, `:loaisp`, `:tensp`, `:mau`, `:size`, `:thuonghieu`, `:giagoc`, `:dongia`, `:mota`, `$filelocation`) ;
					";
					$statement = $this->connect->prepare($query);
					if($statement->execute($form_data))
					{
						$data[] = array(
							'success'	=>	'1'
						);
					}
					else
					{
						$data[] = array(
							'success'	=>	'0'
						);
					}
				}else{
				   print_r($errors);
				}
			 }
			
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}

	function fetch_single($id)
	{
		$query = "SELECT * FROM tbl_sample WHERE id='".$id."'";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			foreach($statement->fetchAll() as $row)
			{
				$data['first_name'] = $row['first_name'];
				$data['last_name'] = $row['last_name'];
			}
			return $data;
		}
	}

	function update()
	{
		if(isset($_POST["first_name"]))
		{
			$form_data = array(
				':first_name'	=>	$_POST['first_name'],
				':last_name'	=>	$_POST['last_name'],
				':id'			=>	$_POST['id']
			);
			$query = "
			UPDATE tbl_sample 
			SET first_name = :first_name, last_name = :last_name 
			WHERE id = :id
			";
			$statement = $this->connect->prepare($query);
			if($statement->execute($form_data))
			{
				$data[] = array(
					'success'	=>	'1'
				);
			}
			else
			{
				$data[] = array(
					'success'	=>	'0'
				);
			}
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
	function delete($id)
	{
		$query = "DELETE FROM sanpham WHERE idsanpham = '".$id."' ";
		$statement = $this->connect->prepare($query);
		if($statement->execute())
		{
			$data[] = array(
				'success'	=>	'1'
			);
		}
		else
		{
			$data[] = array(
				'success'	=>	'0'
			);
		}
		return $data;
	}
}

?>