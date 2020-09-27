<?php
require 'restful_api.php';
include_once("DataProvider.php");

class api extends restful_api {
    
    
	public function __construct(){
        parent::__construct();
       
	}

	public function sanphams(){

        $db=new DataProvider();

		if ($this->method == 'GET'){
			// Hãy viết code xử lý LẤY dữ liệu ở đây
            // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
            $string="";
            if(isset($_GET['fields']))
                $string=$_GET['fields'];
            $fields=explode(',',$string);
            if(empty($fields[0])){
                unset($fields);
                $fields=array();
            }
            $allowArray=array("idsanpham","tensp","tenloai","loaisp","mau","size","thuonghieu","giagoc","dongia","mota","hinhanh");
            $count=count($fields);
            if(isset($_GET['limit'])){
                $sql="select * from sanpham";
                $total=$db->NumRows($sql);
                $item_per_page=$_GET["limit"];
                $data=ceil($total/$item_per_page);
                if(isset($_GET['page'])){
                    $page=$_GET["page"];
                    $start= ( $page * $item_per_page ) - $item_per_page;
                    $sql="SELECT a.idsanpham,b.tenloai,a.tensp,a.mau,a.size,a.thuonghieu,a.giagoc,a.dongia,a.mota,a.hinhanh
                    FROM sanpham a INNER JOIN loaisp b 
                    WHERE a.loaisp = b.idloai LIMIT $start,$item_per_page";
                    $data=$db->FetchAll($sql);
                    return $this->response(200, $data);
                }

                return $this->response(200, $data);
            }
            if(isset($_GET['q'])){
                $tmp=$_GET['q'];
                $targets=explode(' ',$tmp);
                $count=count($targets);
                $sql='select * from sanpham where ';
               
                if($count>1){
                   
                    for ($i=1;$i<=$count;$i++){
                        if($i!=$count){
                            $sql .='idsanpham="'.$targets[$i-1].'" or tensp="'.$targets[$i-1].'" or ';
                        }
                        else{
                            $sql .='idsanpham="'.$targets[$i-1].'" or tensp="'.$targets[$i-1].'"';
                        }
                    }
                }
                else{
                            $sql .='idsanpham="'.$targets[0].'" or tensp="'.$targets[0].'"';
                    
                }
               
                $data=$db->FetchAll($sql);
                return $this->response(200, $data);
            }
            if(isset($_GET['sort'])){
                if (($key = array_search('tenloai', $allowArray)) !== false) {
                    unset($allowArray[$key]);
                }
                $string=$_GET['sort'];
               
                if($string[0]=='-'){
                    $string=ltrim($string,'-');
                    $sql="select * from sanpham order by $string DESC";
                }
                else{
                    $string=ltrim($string,'+');
                    $sql="select * from sanpham order by $string ASC";
                }
                $data=$db->FetchAll($sql);
                return $this->response(200, $data);
            }
           
            if($this->params){
                if($this->params[0]=="show-ten-loai"){
    
                    if($count>0){
                        for($i=1; $i<=$count; $i++){
                            if(!in_array($fields[$i-1],$allowArray))
                                return $this->response(405, "fields not allow");
                        }
                        $sql="select ";
                        for($i=1; $i<=$count; $i++){
                           
                            if($i!=$count){
                                if($fields[$i-1]=='tenloai')
                                    $sql .="loaisp.tenloai, ";
                                else
                                    $sql .="sanpham.". $fields[$i-1] .", ";
                            }
                            else if($i==$count){
                                if($fields[$i-1]=='tenloai')
                                    $sql .="loaisp.tenloai ";
                                else
                                    $sql .="sanpham.". $fields[$i-1] ." ";
                            }
                        }
                        $sql .="from sanpham  inner join loaisp  where sanpham.loaisp=loaisp.idloai";
                    }
                    else{
                        $sql="select sanpham.idsanpham, sanpham.tensp, loaisp.tenloai, sanpham.mau, sanpham.size, sanpham.thuonghieu, sanpham.giagoc, sanpham.dongia, sanpham.mota, sanpham.hinhanh 
                                from sanpham  inner join loaisp  where sanpham.loaisp=loaisp.idloai";
                    }
                    $data=$db->FetchAll($sql);
                    return $this->response(200, $data);
                }
                else{
                    $id=$this->params[0];
                    if($count>0){
                        if (($key = array_search('tenloai', $allowArray)) !== false) {
                            unset($allowArray[$key]);
                        }
                        for($i=1; $i<=$count; $i++){
                            if(!in_array($fields[$i-1],$allowArray))
                                return $this->response(405, "fields not allow");
                        }
                        $sql="select ";
                        for($i=1; $i<=$count; $i++){
                    
                            if($i!=$count){
                                    $sql .="sanpham.". $fields[$i-1] .", ";
                            }
                            else if($i==$count){
                                    $sql .="sanpham.". $fields[$i-1] ." ";
                            }
                        }
                        $sql .="from sanpham  where idsanpham='$id'";
                    }
                    else{
                        $sql="select * from sanpham where idsanpham='$id'";
                    }
                    if(count($this->params)>1){
                        if($this->params[1]=="show-ten-loai"){
                            if($count>0){
                                for($i=1; $i<=$count; $i++){
                                    if(!in_array($fields[$i-1],$allowArray))
                                        return $this->response(405, "fields not allow");
                                }
                                $sql="select ";
                                for($i=1; $i<=$count; $i++){
                                
                                    if($i!=$count){
                                        if($fields[$i-1]=='tenloai')
                                            $sql .="loaisp.tenloai, ";
                                        else
                                            $sql .="sanpham.". $fields[$i-1] .", ";
                                    }
                                    else if($i==$count){
                                        if($fields[$i-1]=='tenloai')
                                            $sql .="loaisp.tenloai ";
                                        else
                                            $sql .="sanpham.". $fields[$i-1] ." ";
                                    }
                                }
                                $sql .="from sanpham  inner join loaisp  where sanpham.loaisp=loaisp.idloai and sanpham.idsanpham='$id'";
                            }
                            else{
                                $sql="select sanpham.idsanpham, sanpham.tensp, loaisp.tenloai, sanpham.mau, sanpham.size, sanpham.thuonghieu, sanpham.giagoc, sanpham.dongia, sanpham.mota, sanpham.hinhanh 
                                from sanpham  inner join loaisp  where sanpham.loaisp=loaisp.idloai and sanpham.idsanpham='$id'";
                            }
                        }
                        else{
                            return $this->response(404, "Not Found");
                        }
                    }
                    $data=$db->Fetch($sql);
                    return $this->response(200, $data);
                }
                
            }
            else{
                if($count>0){
                    if (($key = array_search('tenloai', $allowArray)) !== false) {
                        unset($allowArray[$key]);
                    }
                    for($i=1; $i<=$count; $i++){
                        if(!in_array($fields[$i-1],$allowArray))
                            return $this->response(405, "fields not allow");
                    }
                    $sql="select ";
                    for($i=1; $i<=$count; $i++){
                       
                        if($i!=$count){
                            $sql .="sanpham.". $fields[$i-1] .", ";
                        }
                        else if($i==$count){
                            $sql .="sanpham.". $fields[$i-1] ." ";
                        }
                    }
                    $sql .="from sanpham";
                }
                else{
                    $sql="select * from sanpham";
                }
                    $data=$db->FetchAll($sql);
                if(empty($data)){
                    return $this->response(404, "Not Found");
                }
                return $this->response(200, $data);
            }
           
            
        }
		else if ($this->method == 'POST'){
			// Hãy viết code xử lý THÊM dữ liệu ở đây
            // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
            if($this->params){
                return $this->response(405, "Method not allow");
            }
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);
            $sql="  INSERT INTO `sanpham` (`idsanpham`, `loaisp`, `tensp`, `mau`, `size`, `thuonghieu`, `giagoc`, `dongia`, `mota`, `hinhanh`) 
            VALUES ('$obj[idsanpham]', '$obj[loaisp]', '$obj[tensp]', '$obj[mau]', '$obj[size]', '$obj[thuonghieu]', '$obj[giagoc]', '$obj[dongia]', '$obj[mota]',  '$obj[hinhanh]') ;";
            $db->ExecuteQuery($sql);
            return $this->response(200, "Post thanh cong");
		}
		else if ($this->method == 'PUT'){
			// Hãy viết code xử lý CẬP NHẬT dữ liệu ở đây
            // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);
            if($this->params){
                $id=$this->params[0];
                $sql="select * from sanpham where idsanpham='$id'";
                $check=$db->Fetch($sql);
                if($check){
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
                    WHERE idsanpham='$id'";
                    $db->ExecuteQuery($sql);
                    return $this->response(200, "Update thanh cong");
                }
                else{
                    return $this->response(404, "ERROR: id san pham khong ton tai");
                }
            }
            else{
                return $this->response(405, "Method not allow");
            }
           
           
        }
        else if ($this->method == 'DELETE'){
            if($this->params){
                $id=$this->params[0];
                $sql="UPDATE chitiethoadon SET idsanpham='DELETED' WHERE idsanpham='$id';delete from sanpham where idsanpham='$id'";
                $db->ExecuteMultiQuery($sql);
                return $this->response(200, "Delete thanh cong");
            }
            else{
                return $this->response(405, "Method not allow");
            }
        }
	
    }
    
    public function loaisps(){
        
        $db=new DataProvider();

		if ($this->method == 'GET'){
			// Hãy viết code xử lý LẤY dữ liệu ở đây
            // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
            $string='';
            if(isset($_GET['fields']))
                $string=$_GET['fields'];
            $fields=explode(',',$string);
            if(empty($fields[0])){
                unset($fields);
                $fields=array();
            }
            $allowArray=array("idsanpham","tensp","tenloai","idloai","loaisp","mau","size","thuonghieu","giagoc","dongia","mota","hinhanh");
            $count=count($fields);
            
            if($this->params){
                
                $id=$this->params[0];
                if(count($this->params)>1){
                    if($count>0){
                        if($this->params[1]=='sanphams'){
                            for($i=1; $i<=$count; $i++){
                                if(!in_array($fields[$i-1],$allowArray))
                                    return $this->response(405, "fields not allow");
                            }
                            $sql="select ";
                            for($i=1; $i<=$count; $i++){
                            
                                if($i!=$count){
                                    if($fields[$i-1]=='tenloai' || $fields[$i-1]=='idloai')
                                        $sql .="loaisp.".$fields[$i-1].", ";
                                    else
                                        $sql .="sanpham.". $fields[$i-1] .", ";
                                }
                                else if($i==$count){
                                    if($fields[$i-1]=='tenloai' || $fields[$i-1]=='idloai')
                                        $sql .="loaisp.".$fields[$i-1]." ";
                                    else
                                        $sql .="sanpham.". $fields[$i-1] ." ";
                                }
                            }
                            $sql .="from sanpham  inner join loaisp  where sanpham.loaisp=loaisp.idloai and idloai=$id";
                            $data=$db->Fetch($sql);
                            
                        }
                        else{
                            return $this->response(404, "Bad URL");
                        }
                    }
                    else{
                        $sql="  SELECT a.idsanpham,b.tenloai,a.tensp,a.mau,a.size,a.thuonghieu,a.giagoc,a.dongia,a.mota,a.hinhanh
                                FROM sanpham a INNER JOIN loaisp b 
                                WHERE a.loaisp = b.idloai and idloai=$id";
                        $data=$db->Fetch($sql);
                        
                    }
                }
                else{
                    $sql="SELECT * FROM loaisp WHERE idloai=$id";
                    $data=$db->Fetch($sql);
                   
                }
            }
            else{
                $sql="SELECT * FROM loaisp";
                $data=$db->FetchAll($sql);
            }
            if(!$data)
                return $this->response(404, "Not Found");
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
               
                $sql="SELECT * FROM user WHERE username=$obj[username]";
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
                $sql="SELECT * FROM user WHERE username=$obj[username]";
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
            $data="Error";
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $datetime=date("Y-m-d h:i:sa");
            $sql="INSERT INTO hoadon (idbill,iduser,noigiao,ngaydathang,tongtien)
                    VALUE (NULL,'$obj[iduser]','$obj[noigiao]',$datetime,$obj[tongtien])";
            $data=$db->ExecuteQueryInsert($sql);
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
        else if ($this->method=="POST"){
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);
            $sql="INSERT INTO chitiethoadon(idbill,idsanpham,soluong,dongia,thanhtien)
            VALUE($obj[idbill],$item[idsanpham],$item[soluong],$item[dongia],$item[soluong]*$item[dongia])";
            $db->ExecuteQuery($sql);
            $data="OK";
            return $this->response(200, $data);
        }
    }
}

$api_connect = new api();
?>