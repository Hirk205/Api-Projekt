<?php
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
?>