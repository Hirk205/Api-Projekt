<?php
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
?>