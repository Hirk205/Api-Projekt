<?php
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
                        $sql .='idsanpham like "%'.$targets[$i-1].'%" or tensp="%'.$targets[$i-1].'%" or ';
                    }
                    else{
                        $sql .='idsanpham like "%'.$targets[$i-1].'%" or tensp="%'.$targets[$i-1].'%" ';
                    }
                }
            }
            else{
                        $sql .='idsanpham like "%'.$targets[0].'%" or tensp like "%'.$targets[0].'%"';
                
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
                        return $this->response(405, "Method Not Allow");
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
        $json = file_get_contents('php://input');
        $obj = json_decode($json,true);
        if($this->params){
            $id=$this->params[0];
            $sql="select * from sanpham where idsanpham='$id'";
            $check=$db->Fetch($sql);
            if($check){
                $sql="  UPDATE sanpham
                SET loaisp=$obj[loaisp],
                    tensp='$obj[tensp]',
                    mau='$obj[mau]',
                    size='$obj[size]',
                    thuonghieu='$obj[thuonghieu]',
                    giagoc='$obj[giagoc]',
                    dongia='$obj[dongia]',
                    mota='$obj[mota]',
                    hinhanh='$obj[hinhanh]'
                WHERE idsanpham='$id'";
                if($db->ExecuteQuery($sql)){
                    return $this->response(200, "Update success");
                }
                else{
                    return $this->response(404, "ERROR: Update fail");
                }
            }
            else{
                return $this->response(404, "ERROR: id san pham khong ton tai");
            }
        }
      
        $sql="  INSERT INTO `sanpham` (`idsanpham`, `loaisp`, `tensp`, `mau`, `size`, `thuonghieu`, `giagoc`, `dongia`, `mota`, `hinhanh`) 
        VALUES ('$obj[idsanpham]', '$obj[loaisp]', '$obj[tensp]', '$obj[mau]', '$obj[size]', '$obj[thuonghieu]', '$obj[giagoc]', '$obj[dongia]', '$obj[mota]',  '$obj[hinhanh]') ;";
        if($db->ExecuteQuery($sql)){
            return $this->response(200, "Insert success");
        }
        else{
            return $this->response(404, "ERROR: Insert fail");
        }
    }
    else if ($this->method == 'PUT'){
        // Hãy viết code xử lý CẬP NHẬT dữ liệu ở đây
        // trả về dữ liệu bằng cách gọi: $this->response(200, $data)
        if($this->params){
            $json = file_get_contents('php://input');
            $obj = json_decode($json,true);
            $id=$this->params[0];
            $sql="select * from sanpham where idsanpham='$id'";
            $check=$db->Fetch($sql);
            if($check){
                $sql="  UPDATE sanpham
                SET loaisp=$obj[loaisp],
                    tensp='$obj[tensp]',
                    mau='$obj[mau]',
                    size='$obj[size]',
                    thuonghieu='$obj[thuonghieu]',
                    giagoc='$obj[giagoc]',
                    dongia='$obj[dongia]',
                    mota='$obj[mota]',
                    hinhanh='$obj[hinhanh]'
                WHERE idsanpham='$id'";
                if($db->ExecuteQuery($sql)){
                    return $this->response(200, "Update success");
                }
                else{
                    return $this->response(404, "ERROR: Update fail");
                }
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
            return $this->response(200, "Delete success");
        }
        else{
            return $this->response(405, "Method not allow");
        }
    }


?>