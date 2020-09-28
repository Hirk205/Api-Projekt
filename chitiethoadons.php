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
        return $this->response(405, "Method not allow");
    }
    else if ($this->method=="PUT"){
        return $this->response(405, "Method not allow");
    }
    else if($this->method=="DELETE"){
        return $this->response(405, "Method not allow");
    }
?>