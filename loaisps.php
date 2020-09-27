<?php
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
                        
                        $data=$db->FetchAll($sql);
                        
                    }
                    else{
                        return $this->response(404, "Bad URL");
                    }
                }
                else{
                    $sql="  SELECT a.idsanpham,b.tenloai,a.tensp,a.mau,a.size,a.thuonghieu,a.giagoc,a.dongia,a.mota,a.hinhanh
                            FROM sanpham a INNER JOIN loaisp b 
                            WHERE a.loaisp = b.idloai and idloai=$id";
                    $data=$db->FetchAll($sql);
                    
                }
            }
            else{
                $sql="SELECT * FROM loaisp WHERE idloai=$id";
                $data=$db->Fetch($sql);
               
            }
        }
        else{
            
            $sql="SELECT * FROM loaisp";
            if($count>0){
                $sql="select ";
                $tmpAllowArray=array('idloai','tenloai');
                for($i=1;$i<=$count;$i++){
                    if(!in_array($fields[$i-1],$allowArray))
                        return $this->response(405, "fields not allow");
                    if($i!=$count){
                        $sql.=$fields[$i-1].",";
                    }
                    else{
                        $sql.=$fields[$i-1]." ";
                    }
                }
                $sql.="from loaisp";
            }
            $data=$db->FetchAll($sql);
        }
        if(!$data)
            return $this->response(404, "Not Found");
        return $this->response(200, $data);
    }
    else if ($this->method == 'POST'){
        // Hãy viết code xử lý THÊM dữ liệu ở đây
        // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
        if($this->params){
            return $this->response(405, "method not allow");
        }
        else{
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);
            
            $sql="  INSERT INTO `loaisp` (`idloai`, `tenloai`)
                    VALUES (NULL, '$obj[tenloai]')";
            $data=$db->ExecuteQuery($sql);
            return $this->response(200, $data);
        }
    }
    else if ($this->method == 'PUT'){
        // Hãy viết code xử lý CẬP NHẬT dữ liệu ở đây
        // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
        if($this->params){
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);
            $id=$this->params[0];
            $sql="  UPDATE loaisp
                    SET tenloai='$obj[tenloai]'
                    WHERE idloai='$id'";
            $data=$db->ExecuteQuery($sql);
            return $this->response(200, "Update success");
        }
        else{
            return $this->response(405, "method not allow");
        }
    }
    else if ($this->method == 'DELETE'){
        if($this->params){
            $id=$this->params[0];
            $sql="UPDATE sanpham SET loaisp=-1 WHERE loaisp=$id;delete from loaisp where idloai=$id";
            $db->ExecuteMultiQuery($sql);
            return $this->response(200, "Delete thanh cong");
        }
        else{
            return $this->response(405, "method not allow");
        }
    }

?>