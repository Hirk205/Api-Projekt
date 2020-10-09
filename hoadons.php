<?php
     if($this->method=="GET"){
        $string="";
        if(isset($_GET['fields']))
            $string=$_GET['fields'];
        $fields=explode(',',$string);
        if(empty($fields[0])){
            unset($fields);
            $fields=array();
        }
        $allowArray=array("idbill","iduser","noigiao","ngaydathang","tongtien","idsanpham","soluong","dongia","thanhtien");
        $count=count($fields);

        if($this->params){
            $id=$this->params[0];
            if(count($this->params)>1){
                if($this->params[1]=="chitiethoadons"){
                    if (($key = array_search('tongtien', $allowArray)) !== false) {
                        unset($allowArray[$key]);
                    }
                    if($count>0){
                        $sql="select ";
                        for ($i=1; $i<=$count;$i++){
                            if(!in_array($fields[$i-1],$allowArray))
                                return $this->response(405, "fields not allow");
                            if($i!=$count){
                                if($fields[$i-1]=='dongia' || $fields[$i-1]=='soluong' || $fields[$i-1]=='thanhtien')
                                    $sql .="chitiethoadon.". $fields[$i-1] .", ";
                                else
                                    $sql .="hoadon.". $fields[$i-1] .", ";
                            }
                            else if($i==$count){
                                if($fields[$i-1]=='dongia' || $fields[$i-1]=='soluong' || $fields[$i-1]=='thanhtien')
                                    $sql .="chitiethoadon.". $fields[$i-1] ." ";
                                else
                                    $sql .="hoadon.". $fields[$i-1] ." ";
                            }
                        }
                        $sql.="from hoadon where idbill=$id";
                    }
                    else{
                        $sql="select hoadon.idbill, iduser, noigiao, ngaydathang, idsanpham, soluong, thanhtien from hoadon inner join chitiethoadon on hoadon.idbill=chitiethoadon.idbill and hoadon.idbill=$id";
                    }
                    $data=$db->FetchAll($sql);
                    return $this->response(200, $data);
                }
                else{
                    return $this->response(405, "URL not allow");
                }
            }
            else{
                if($count>0){
                    $allowArray=array("idbill","iduser","noigiao","ngaydathang","tongtien");
                    $sql="select ";
                    for ($i=1; $i<=$count;$i++){
                        if(!in_array($fields[$i-1],$allowArray))
                            return $this->response(405, "fields not allow");
                        if($i!=$count){
                            $sql .=$fields[$i-1].",";
                        }
                        else{
                            $sql .=$fields[$i-1]." ";
                        }
                    }
                    $sql.="from hoadon where idbill=$id";
                }
                else{
                    $sql ="select * from hoadon where idbill=$id";
                }
                $data=$db->Fetch($sql);
                return $this->response(200, $data);
            }
        }
        else{  if($count>0){
            $allowArray=array("idbill","iduser","noigiao","ngaydathang","tongtien");
            $sql="select ";
            for ($i=1; $i<=$count;$i++){
                if(!in_array($fields[$i-1],$allowArray))
                    return $this->response(405, "fields not allow");
                if($i!=$count){
                    $sql .=$fields[$i-1].",";
                }
                else{
                    $sql .=$fields[$i-1]." ";
                }
            }
            $sql.="from hoadon where idbill";
            }
            else{
                $sql="SELECT * FROM hoadon";
            }
           
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
                VALUE (NULL,'$obj[iduser]','$obj[noigiao]','$datetime','$obj[tongtien]')";
        $lastID=$db->ExecuteQueryInsert($sql);
        foreach($obj["0"] as $i=>$j){
            $sum=$j['soluong']*$j['dongia'];
            $sql="INSERT INTO chitiethoadon(idbill,idsanpham,soluong,dongia,thanhtien)
            VALUE('$lastID','$j[idsanpham]','$j[soluong]','$j[dongia]','$sum')";
            $db->ExecuteQuery($sql);
        }
        return $this->response(200, "OK");
    }
    else if($this->method=="PUT"){
        
        return $this->response(405, "ERROR: method not allow");
    }
    else if ($this->method=="DELETE"){
        if($this->params){
            $id=$this->params[0];
            $sql="delete from chitiethoadon where idbill=$id; delete from hoadon where idbill=$id";
            if($db->ExecuteMultiQuery($sql))
                return $this->response(200, "Delete success");
            else
                return $this->response(404, "Delete fail");
        }
        else{
            return $this->response(405, "ERROR: method not allow");
        }
    }
?>