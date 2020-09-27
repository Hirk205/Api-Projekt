<?php
    if($this->method=="GET"){
        if($this->params){
            $id=$this->params[0];
            $sql="SELECT * FROM chitiethoadon WHERE idbill=$_GET[idbill]";
            $data=$db->Fetch($sql);
            return $this->response(200, $data);
        }
        else{
            $sql="select * from chitiethoadon";
            $data=$db->FetchAll($sql);
            return $this->response(200, $data);
        }
        
    }
    else if ($this->method=="POST"){
        $json = file_get_contents('php://input');
        $obj = json_decode($json,true);
        $sql="INSERT INTO chitiethoadon(idbill,idsanpham,soluong,dongia,thanhtien)
        VALUE('$obj[idbill]','$obj[idsanpham]','$obj[soluong]','$obj[dongia]','$obj[soluong]'*'$obj[dongia]')";
        if($db->ExecuteQuery($sql))
     
            return $this->response(200, "Insert chitiethoadon success");
        else    
        return $this->response(404, "Insert chitiethoadon fail");
    }
    else if ($this->method=="PUT"){
        return $this->response(405, "Method not allow");
    }
    else if($this->method=="DELETE"){
        return $this->response(405, "Method not allow");
    }
?>