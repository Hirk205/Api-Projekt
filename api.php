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
            if(isset($_GET["idsanpham"])){
                $sql="SELECT * FROM sanpham WHERE idsanpham='$_GET[idsanpham]'";
                $data=$db->Fetch($sql);
            }
            else{
                $sql="SELECT * FROM sanpham";
                $data=$db->FetchAll($sql);
            }    
             return $this->response(200, $data);
		}
		else if ($this->method == 'POST'){
			// Hãy viết code xử lý THÊM dữ liệu ở đây
            // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);
           
            $sql="  INSERT INTO `sanpham` (`idsanpham`, `loaisp`, `tensp`, `mau`, `size`, `thuonghieu`, `giagoc`, `dongia`, `mota`, `hinhanh`) 
                    VALUES ('$obj[idsanpham]', '$obj[loaisp]', '$obj[tensp]', '$obj[mau]', '$obj[size]', '$obj[thuonghieu]', '$obj[giagoc]', '$obj[dongia]', '$obj[mota]', '$obj[hinhanh]') ;";
            $data=$db->ExecuteQuery($sql);
            return $this->response(200, $data);
		}
		else if ($this->method == 'PUT'){
			// Hãy viết code xử lý CẬP NHẬT dữ liệu ở đây
            // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);
            if(isset($_GET["delete"])){
                $sql="UPDATE chitiethoadon SET idsanpham='NONE/Deleted' WHERE idsanpham='$obj[idsanpham]'; DELETE FROM sanpham WHERE idsanpham='$obj[idsanpham]'";
                $data=$db->ExecuteQuery($sql);
            }
            else{
                $sql="  UPDATE sanpham
                        SET loaisp='$obj[loaisp]',
                            tensp='$obj[tensp]',
                            mau='$obj[mau]',
                            size='$obj[size]',
                            thuonghieu='$obj[thuonghieu]',
                            giagoc=$obj[giagoc],
                            dongia=$obj[dongia],
                            mota='$obj[mota]',
                            hinhanh='$obj[hinhanh]',
                        WHERE idsanpham=$obj[idsanpham]";
                         $data=$db->ExecuteMultiQuery($sql);
            }
           
            return $this->response(200, $data);
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
            return $this->response(200, $data);
		}
		else if ($this->method == 'POST'){
			// Hãy viết code xử lý THÊM dữ liệu ở đây
            // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);
            
            $sql="  INSERT INTO `loaisp` (`idloai`, `tenloai`)
                    VALUES (NULL, '$obj[tenloai]')";
            $data=$db->ExecuteQuery($sql);
            return $this->response(200, $data);
		}
		else if ($this->method == 'PUT'){
			// Hãy viết code xử lý CẬP NHẬT dữ liệu ở đây
            // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);

            if(isset($_GET['delete'])){
                $sql="UPDATE sanpham SET loaisp=-1 WHERE loaisp=$obj[idloai];DELETE FROM loaisp WHERE idloai=$obj[idloai];";
                $data=$db->ExecuteMultiQuery($sql);
                return $this->response(200, $data);
            }
            else{
            $sql="  UPDATE loaisp
                    SET tenloai='$obj[tenloai]'
                    WHERE idloai=$obj[idloai]";
            $data=$db->ExecuteQuery($sql);
            return $this->response(200, $data);
            }
		}
		
    }
    
    public function user(){
        $db=new DataProvider();

        if ($this->method== 'GET'){
            if(isset($_GET['iduser'])){
                $sql="SELECT * FROM user WHERE iduser=$_GET[iduser]";
                $data=$db->Fetch($sql);
            }
            else{
                $sql="SELECT * FROM  user";
                $data=$db->FetchAll($sql);
            }
            return $this->response(200, $data);
        }
        else if ($this->method == 'POST'){
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);
            $data=0;
            if($isset($_GET['login'])){
               
                $sql="SELECT * FROM user WHERE username=$obj['username']";
                if($db->NumRows($sql)){
                    $user=$db->Fetch($sql);
                    $hashed_password= $user['password'];
                    if(password_verify($obj['password'],$hashed_password )){
                        $data=$db->Fetch($sql);
                    }
                }
                return $this->response(200, $data);
            }
            else{
                $sql="SELECT * FROM user WHERE username=$obj['username']";
                if($db->NumRows($sql)){
                    return $this->response(200, $data);
                }
                else{
                    $date= date("Y/m/d");
                    $password = password_hash($obj['password'], PASSWORD_BCRYPT, array('cost'=>12));
                    $sql="INSERT INTO user (iduser,username,password,phone,address,dob,level)
                        VALUES (NULL,'$obj[username]',$password,'$obj[phone]','$obj[address]',$date,b'0')";
                    $data=$db->ExecuteQuery($sql);
                    return $this->response(200, $data);
                }
            }
           
        }
        else if ($this->method == 'PUT'){
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);

            if(isset($_GET['delete'])){
                $sql="UPDATE hoadon SET iduser=-1 WHERE iduser=$obj[iduser] ;DELETE FROM user WHERE iduser=$obj[iduser]";
                $data=$db->ExecuteMultiQuery($sql);
            }
            else{
                $sql="  UPDATE user 
                        SET phone=$obj[phone]
                            address=$obj[address]";
                $data=$db->ExecuteQuery($sql);
            }

            
            return $this->response(200, $data);
        }
    }

    public function hoadon(){
        $db= new DataProvider();
        if($this->method=="GET"){
            if(isset($_GET['idbill'])){
                $sql="SELECT * FROM hoadon WHERE idbill=$_GET[idbill]";
                $data=$db->Fetch($sql);
            }
            else if(isset($_GET['iduser'])){
                $sql="SELECT * FROM hoadon WHERE iduser=$_GET[iduser]";
                $data=$db->FetchAll($sql);
            }
            else{
                $sql="SELECT * FROM hoadon";
                $data=$db->FetchAll($sql);
            }
            return $this->response(200, $data);
        }
        else if($this->method=="POST"){
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $datetime=date("Y-m-d h:i:sa");
            $sql="INSERT INTO hoadon (idbill,iduser,noigiao,ngaydathang,tongtien)
                    VALUE (NULL,'$obj[iduser]','$obj[noigiao]',$datetime,$obj[tongtien])";
            $LastID=$db->ExecuteQueryInsert($sql);
            foreach($obj['sanpham'] as $item){
                $sql="INSERT INTO chitiethoadon(idbill,idsanpham,soluong,dongia,thanhtien)
                        VALUE($LastID,$item[idsanpham],$item[soluong],$item[dongia],$item[soluong]*$item[dongia])";
                $data=$db->ExecuteQuery($sql);
            }
            return $this->response(200, $data);
        }
        else if($this->method=="PUT"){
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);
            if(isset($_GET["delete"])){
                $sql="DELETE FROM chitiethoadon WHERE idbill=$obj[idbill];
                        DELETE FROM hoadon WHERE idbill=$obj[idbill]";
                $data=$db->ExecuteQuery($sql);
            }
            return $this->response(200, $data);
        }
    }

    public function chitiethoadon(){
        $db= new DataProvider();
        if($this->method=="GET"){
            if(isset($_GET['idbill'])){
                $sql="SELECT * FROM chitiethoadon WHERE idbill=$_GET[idbill]";
                $data=$db->FetchAll($sql);
                return $this->response(200, $data);
            }
            
        }
    }
}

$api_connect = new api();
?>