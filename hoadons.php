<?php
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
?>