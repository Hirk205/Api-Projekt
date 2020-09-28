<?php
    if ($this->method== 'GET'){
        $string="";
        if(isset($_GET['fields']))
            $string=$_GET['fields'];
        $fields=explode(',',$string);
        if(empty($fields[0])){
            unset($fields);
            $fields=array();
        }
        $allowArray=array("iduser","username","idbill","noigiao","ngaydathang","tongtien");
        $count=count($fields);
        if($this->params){
            if(!is_numeric($this->params[0])){
                return $this->response(404, "Bad URL");
            }
            $id=$this->params[0];
            if(count($this->params)>1){
                if($this->params[1]=="hoadons"){
                    if($count>0){
                        $sql="select ";
                        for ($i=1; $i<=$count;$i++){
                            if(!in_array($fields[$i-1],$allowArray))
                                return $this->response(405, "fields not allow");
                                if($i!=$count){
                                    if($fields[$i-1]=='username' || $fields[$i-1]=='iduser')
                                        $sql .="user.username, ";
                                    else
                                        $sql .="hoadon.". $fields[$i-1] .", ";
                                }
                                else if($i==$count){
                                    if($fields[$i-1]=='username' || $fields[$i-1]=='iduser')
                                        $sql .="user.username ";
                                    else
                                        $sql .="hoadon.". $fields[$i-1] ." ";
                                }
                        }
                        $sql.="from hoadon where iduser=$id";
                    }
                    else{
                        $sql="select * from hoadon where iduser=$id";
                    }
                    $data=$db->FetchAll($sql);
                    return $this->response(200, $data);
                }
                else   if($this->params[1]=="delete"){
                    $sql="select idbill from hoadon inner join user on hoadon.iduser=user.iduser where user.iduser=$id";
                    $getData=$db->Fetch($sql);
                    $idbill=$getData['idbill'];
                    if($idbill){
                    $sql="  delete from chitiethoadon where idbill=$idbill; 
                            delete from hoadon where iduser=$id; 
                            delete from user where iduser=$id";
                    $db->ExecuteMultiQuery($sql);
                    return $this->response(200, "Delete success");}
                    else
                    return $this->response(404, "Delete fail");
                }
                else{
                    return $this->response(405, "URL not allow");
                }

            }
            else{
                if($count>0){
                    $allowArray=array("iduser","username","password","phone","address","dob","level");
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
                    $sql.="from user where iduser=$id";
                }
                else{
                    $sql="select * from user where iduser=$id";
                }
                $data=$db->Fetch($sql);
                return $this->response(200, $data);
                }
        }
        
        else{
            if($count>0){
                $allowArray=array("iduser","username","password","phone","address","dob","level");
                $sql="select ";
                for ($i=1; $i<=$count;$i++){
                    if(!in_array($fields[$i-1],$allowArray))
                        return $this->response(405, "fields not allow");
                        if($i!=$count){
                            $sql .= $fields[$i-1] .", ";
                        }
                        else if($i==$count){
                            $sql .= $fields[$i-1] ." ";
                        }
                }
                $sql.="from user ";
            }
            else{
                $sql="select * from user";
            }
            $data=$db->FetchAll($sql);
            return $this->response(200, $data);
            $sql="SELECT * FROM  user";
            $data=$db->FetchAll($sql);
        }
        return $this->response(200, $data);
    }
    else if ($this->method == 'POST'){
        $json = file_get_contents('php://input');
        $obj = json_decode($json,true);
        $data=0;
        if($this->params){
            $id=$this->params[0];
            $sql="select * from user where iduser=$id";
            
            $check=$db->Fetch($sql);
            if($check){
                if(isset($_GET['action'])){
                    $action=$_GET['action'];
                    if($action=="promote"){
                        $sql="  UPDATE user 
                        SET level=b'1'
                        where iduser=$id";
                       
                    }
                    else if ($action=="demote"){
                        $sql="  UPDATE user 
                        SET level=b'0'
                        where iduser=$id";
                       
                    }
                    else{
                        return $this->response(404, "ERROR: Unknown action");
                    }
                    if($db->ExecuteQuery($sql)){
                        return $this->response(200,"Update success");
                    }
                    else{
                        return $this->response(404, "ERROR: Update fail");
                    }
                }
                else{
                    $sql="  UPDATE user 
                            SET phone='$obj[phone]',
                                address='$obj[address]'
                            where iduser=$id";
                    if($db->ExecuteQuery($sql)){
                        return $this->response(200, "Update success");
                    }
                    else{
                        return $this->response(404, "ERROR: Update fail");
                    }
                }
            }
        }
        else{
            if(isset($_GET['action'])){
                $username=$obj['username'];
                $sql="SELECT * FROM user WHERE username='$username'";
                if($db->NumRows($sql)){
                    $user=$db->Fetch($sql);
                    $hashed_password= $user['password'];
                    if(password_verify($obj['password'],$hashed_password )){
                        $data=$db->Fetch($sql);
                        return $this->response(200, $data);
                    }
                }
                else{
                    return $this->response(404, "user not exist");
                }
            }
            else{
                $sql="SELECT * FROM user WHERE username='$obj[username]'";
                if($db->NumRows($sql)){
                    return $this->response(404, "Error: username already exist");
                }
                else{
                    $date= date("Y-m-d");
                    $password = password_hash($obj['password'], PASSWORD_BCRYPT, array('cost'=>12));
                    $sql="INSERT INTO user (iduser,username,password,phone,address,dob,level)
                        VALUES (NULL,'$obj[username]','$password','$obj[phone]','$obj[address]','$date',b'0')";
                    $data=$db->ExecuteQuery($sql);
                    return $this->response(200, "SignUp success");
                }
            }
       }
    }
    else if ($this->method == 'PUT'){
        $json = file_get_contents('php://input');
        $obj = json_decode($json,true);

        if($this->params){
            $id=$this->params[0];
            $sql="select * from user where iduser=$id";
            
            $check=$db->Fetch($sql);
            if($check){
                if(isset($_GET['action'])){
                    $action=$_GET['action'];
                    if($action=="promote"){
                        $sql="  UPDATE user 
                        SET level=b'1'
                        where iduser=$id";
                       
                    }
                    else if ($action=="demote"){
                        $sql="  UPDATE user 
                        SET level=b'0'
                        where iduser=$id";
                       
                    }
                    else{
                        return $this->response(404, "ERROR: Unknown action");
                    }
                    if($db->ExecuteQuery($sql)){
                        return $this->response(200,"Update success");
                    }
                    else{
                        return $this->response(404, "ERROR: Update fail");
                    }
                }
                else{
                    $sql="  UPDATE user 
                            SET phone='$obj[phone]',
                                address='$obj[address]'
                            where iduser=$id";
                    if($db->ExecuteQuery($sql)){
                        return $this->response(200, "Update success");
                    }
                    else{
                        return $this->response(404, "ERROR: Update fail");
                    }
                }
            }
        }
        else{
            return $this->response(405, "method not allow");
        }

        
        return $this->response(200, $data);
    }
    else if ($this->method == 'DELETE'){
        if($this->params){
            $id=$this->params[0];
            $sql="select idbill from hoadon inner join user on hoadon.iduser=user.iduser where user.iduser=$id";
            $getData=$db->Fetch($sql);
            $idbill=$getData['idbill'];
            if($idbill){
            $sql="  delete from chitiethoadon where idbill=$idbill; 
                    delete from hoadon where iduser=$id; 
                    delete from user where iduser=$id";
            $db->ExecuteMultiQuery($sql);
            return $this->response(200, "Delete success");}
            else
            return $this->response(404, "Delete fail");
        }
        else{
            return $this->response(405, "method not allow");
        }
    }
?>