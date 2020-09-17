<?php
require 'restful_api.php';
include_once("DataProvider.php");

class api extends restful_api {
    
    
	public function __construct(){
        parent::__construct();
       
	}

	public function sanpham(){

        $db=new DataProvider();

		if ($this->method == 'GET'){
			// Hãy viết code xử lý LẤY dữ liệu ở đây
            // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
            $sql="SELECT * FROM sanpham";
            
            if($db->NumRows($sql)){
                $data=$db->FetchAll($sql);
            }
            $this->response(200, $data);
		}
		elseif ($this->method == 'POST'){
			// Hãy viết code xử lý THÊM dữ liệu ở đây
            // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
            $idsanpham=$_POST['idsanpham'];
            $loaisp=$_POST['loaisp '];
            $tensp=$_POST['tensp'];
            $mau=$_POST['mau'];
            $size=$_POST['size'];
            $thuonghieu=$_POST['thuonghieu'];
            $giagoc=$_POST['giagoc'];
            $dongia=$_POST['dongia'];
            $mota=$_POST['mota'];
            $hinhanh=$_POST['hinhanh'];
            $sql="  INSERT INTO `sanpham` (`idsanpham`, `loaisp`, `tensp`, `mau`, `size`, `thuonghieu`, `giagoc`, `dongia`, `mota`, `hinhanh`) 
                    VALUES ('$idsanpham', '$loaisp', '$tensp', '$mau', '$size', '$thuonghieu', '$giagoc', '$dongia', '$mota', '$hinhanh') ;";
            $data=$db->ExecuteQuery($sql);
            $this->response(200, $data);
		}
		elseif ($this->method == 'PUT'){
			// Hãy viết code xử lý CẬP NHẬT dữ liệu ở đây
            // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
            $idsanpham=$_POST['idsanpham'];
            $loaisp=$_POST['loaisp '];
            $tensp=$_POST['tensp'];
            $mau=$_POST['mau'];
            $size=$_POST['size'];
            $thuonghieu=$_POST['thuonghieu'];
            $giagoc=$_POST['giagoc'];
            $dongia=$_POST['dongia'];
            $mota=$_POST['mota'];
            $hinhanh=$_POST['hinhanh'];
            $sql="  UPDATE sanpham
                    SET loaisp='$loaisp',
                        tensp='$tensp',
                        mau='$mau',
                        size='$size',
                        thuonghieu='$thuonghieu',
                        giagoc=$giagoc,
                        dongia=$dongia,
                        mota='$mota',
                        hinhanh='$hinhanh',
                    WHERE idsanpham=$idsanpham";
            $data=$db->ExecuteQuery($sql);
            $this->response(200, $data);
		}
		elseif ($this->method == 'DELETE'){
			// Hãy viết code xử lý XÓA dữ liệu ở đây
            // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
            $idsanpham=$_POST['idsanpham'];
            $sql="UPDATE chitiethoadon SET idsanpham='Deleted' WHERE idsanpham=$idsanpham;DELETE FROM sanpham WHERE idsanpham=$idsanpham";
            $data=$db->ExecuteQuery($sql);
            $this->response(200, $data);
		}
    }
    public function loaisp(){
        
        $db=new DataProvider();

		if ($this->method == 'GET'){
			// Hãy viết code xử lý LẤY dữ liệu ở đây
            // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
           
            
            if(isset($_GET["idloai"])){
                $id=$_GET["idloai"];
                $sql="SELECT * FROM loaisp WHERE idloai=$id";
                $data=$db->Fetch($sql);
            }
            else{
                $sql="SELECT * FROM loaisp";
                $data=$db->FetchAll($sql);
            }
            $this->response(200, $data);
		}
		elseif ($this->method == 'POST'){
			// Hãy viết code xử lý THÊM dữ liệu ở đây
            // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);
            
            $sql="  INSERT INTO `loaisp` (`idloai`, `tenloai`)
                    VALUES (NULL, '$obj[tenloai]')";
            $data=$db->ExecuteQuery($sql);
            $this->response(200, $data);
		}
		elseif ($this->method == 'PUT'){
			// Hãy viết code xử lý CẬP NHẬT dữ liệu ở đây
            // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);

            if(isset($_GET['delete'])){
                $sql="UPDATE sanpham SET loaisp=-1 WHERE loaisp=$obj[idloai];DELETE FROM loaisp WHERE idloai=$obj[idloai];";
                $data=$db->ExecuteQuery($sql);
                $this->response(200, $data);
            }
            else{
            $sql="  UPDATE loaisp
                    SET tenloai='$obj[tenloai]'
                    WHERE idloai=$obj[idloai]";
            $data=$db->ExecuteQuery($sql);
            $this->response(200, $data);
            }
		}
		
	}
}

$sanpham = new api();
?>