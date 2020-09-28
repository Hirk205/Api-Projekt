<?php
    include_once("call_api.php");
    if(isset($_POST["update-sanpham"])){
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];
        if($fileSize==0&&$fileName==''){
            $id=$_POST["idsanpham"];
           
            $data_array =  array(
            "idsanpham"        => $_POST["idsanpham"],
            "loaisp"        => $_POST["loaisp"],
            "tensp"        => $_POST["tensp"],
            "mau"        => $_POST["mau"],
            "size"        => $_POST["size"],
            "thuonghieu"        => $_POST["thuonghieu"],
            "giagoc"        => $_POST["giagoc"],
            "dongia"        => $_POST["dongia"],
            "mota"        => $_POST["mota"],
            "hinhanh"        => $_POST["hinhanh"]
            );
            $make_call = callAPI('POST', 'https://myapiwork.000webhostapp.com/api.php/sanphams/'.$id, json_encode($data_array));
        }
        else{
            $fileExt = explode('.',$fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('gif','png','jpg','pnj','jpeg');
            if(in_array($fileActualExt,$allowed)){
            if($fileError==0){
                if($fileSize<1000000){
                $fileNameNew = uniqid('',true).".".$fileActualExt;
        
                $ftp_server = "files.000webhost.com";
                $ftp_user_name = "myapiwork";
                $ftp_user_pass = "myapi0907";
                $destination_file = "/public_html/Image/".$fileNameNew;
                $source_file = $fileTmpName;
                
                // set up basic connection
                $conn_id = ftp_connect($ftp_server);
                ftp_pasv($conn_id, true); 
                
                // login with username and password
                $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 
                
                // check connection
                if ((!$conn_id) || (!$login_result)) { 
                    echo "FTP connection has failed!";
                    echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
                    exit; 
                } else {
                    echo "Connected to $ftp_server, for user $ftp_user_name";
                }
                
                // upload the file
                $upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY); 
                
                // check upload status
                if (!$upload) { 
                    echo "FTP upload has failed!";
                } else {
                    $id=$_POST["idsanpham"];
                    $location="https://myapiwork.000webhostapp.com/Image/". $fileNameNew;
                    $data_array =  array(
                    "loaisp"        => $_POST["loaisp"],
                    "tensp"        => $_POST["tensp"],
                    "mau"        => $_POST["mau"],
                    "size"        => $_POST["size"],
                    "thuonghieu"        => $_POST["thuonghieu"],
                    "giagoc"        => $_POST["giagoc"],
                    "dongia"        => $_POST["dongia"],
                    "mota"        => $_POST["mota"],
                    "hinhanh"        => $location
                    );
                    $make_call = callAPI('POST', 'https://myapiwork.000webhostapp.com/api.php/sanphams/'.$id, json_encode($data_array));
                    
                }
                
                // close the FTP stream 
                ftp_close($conn_id);
        
                }
                else{
                echo "<script>alert('file too big')</script>";
                }
            
            }
            else{
                echo "<script>alert('error upload file')</script>";
            }
            }
            else{
            echo "<script>alert('error')</script>";
            }
        }
    }
    if(isset($_POST["Submit"])){
        $file = $_FILES['file'];
        
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];
    
        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('gif','png','jpg','pnj','jpeg');
        if(in_array($fileActualExt,$allowed)){
          if($fileError==0){
            if($fileSize<1000000){
              $fileNameNew = uniqid('',true).".".$fileActualExt;
    
              $ftp_server = "files.000webhost.com";
              $ftp_user_name = "myapiwork";
              $ftp_user_pass = "myapi0907";
              $destination_file = "/public_html/Image/".$fileNameNew;
              $source_file = $fileTmpName;
              
              // set up basic connection
              $conn_id = ftp_connect($ftp_server);
              ftp_pasv($conn_id, true); 
              
              // login with username and password
              $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); 
              
              // check connection
              if ((!$conn_id) || (!$login_result)) { 
                  echo "FTP connection has failed!";
                  echo "Attempted to connect to $ftp_server for user $ftp_user_name"; 
                  exit; 
              } else {
                  echo "Connected to $ftp_server, for user $ftp_user_name";
              }
              
              // upload the file
              $upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY); 
              
              // check upload status
              if (!$upload) { 
                echo "FTP upload has failed!";
              } else {
                $location="https://myapiwork.000webhostapp.com/Image/". $fileNameNew;
                $data_array =  array(
                  "idsanpham"        => $_POST["idsanpham"],
                  "loaisp"        => $_POST["loaisp"],
                  "tensp"        => $_POST["tensp"],
                  "mau"        => $_POST["mau"],
                  "size"        => $_POST["size"],
                  "thuonghieu"        => $_POST["thuonghieu"],
                  "giagoc"        => $_POST["giagoc"],
                  "dongia"        => $_POST["dongia"],
                  "mota"        => $_POST["mota"],
                  "hinhanh"        => $location
                );
                $make_call = callAPI('POST', 'https://myapiwork.000webhostapp.com/api.php/sanphams', json_encode($data_array));
              
              }
              
              // close the FTP stream 
              ftp_close($conn_id);
    
            }
            else{
              echo "<script>alert('file too big')</script>";
            }
          
          }
          else{
            echo "<script>alert('error upload file')</script>";
          }
        }
        else{
          echo "<script>alert('error')</script>";
        }
    }

?>
<html>
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/b-1.6.4/fh-3.1.7/r-2.2.6/sp-1.2.0/datatables.min.css"/>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> 
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script> 
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script> 
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            } );    
        </script>
        <script>
             function isNumberKey(evt){
                                var charCode = (evt.which) ? evt.which : event.keyCode
                                if (charCode > 31 && (charCode < 48 || charCode > 57))
                                    return false;
                                return true;
                            }
        </script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
        
    </head>
    <body>
    <button class='btn-add btn btn-success' data-toggle='modal' data-target='#addModal'> + Add more sanpham</button>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>idsanpham</th>
                <th>loaisanpham</th>
                <th>tensanpham</th>
                <th>mau</th>
                <th>size</th>
                <th>thuonghieu</th>
                <th>giagoc</th>
                <th>dongia</th>
                <th>mota</th>
                <th>hinhanh</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                 $get_data = callAPI('GET', 'https://myapiwork.000webhostapp.com/api.php/sanphams', false);
                 $data= json_decode($get_data, true);
                 foreach($data as $item){
                    echo "<tr>";
                    echo "<td class='idsanpham'>$item[idsanpham]</td>";
                    echo "<td class='loaisp'>$item[loaisp]</td>";
                    echo "<td class='tensp'>$item[tensp]</td>";
                    echo "<td class='mau'>$item[mau]</td>";
                    echo "<td class='size'>$item[size]</td>";
                    echo "<td class='thuonghieu'>$item[thuonghieu]</td>";
                    echo "<td class='giagoc'>$item[giagoc]</td>";
                    echo "<td class='dongia'>$item[dongia]</td>";
                    echo "<td class='mota'>$item[mota]</td>";
                    echo "<td ><img src='$item[hinhanh]' class='image' style='width:100px; height:50px' ></td>";
                    echo "<td><button class='btn-edit btn btn-primary' data-toggle='modal' data-target='#editModal'>EDIT</button>";
                    echo "<button class='btn-delete btn btn-danger' style='margin-left:10px' >DELETE</button></td>";
                echo "</tr>";
                 }
            ?>
        </tbody>
    </table>
    </body>

  <!-- The Modal -->
  <div class="modal" id="editModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">UpDate</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
                <label >id san pham:</label>
                <input type="hidden" id="idsanpham" name="idsanpham" ><br><br>
                <label>loai san pham</label>
                <select name="loaisp" id="loaisp">
                    <?php
                        $get_data = callAPI('GET', 'https://myapiwork.000webhostapp.com/api.php/loaisps', false);
                        $data= json_decode($get_data, true);
                        foreach($data as $i){
                            echo "<option value=$i[idloai]>$i[tenloai]</option>";
                        }
                    ?>
                </select><br><br>
                <label >ten san pham:</label>
                <input type="text" id="tensp" name="tensp"><br><br>
                <label >mau:</label>
                <input type="text" id="mau" name="mau"><br><br>
                <label >size:</label>
                <select name="size" id="size">
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                </select><br><br>
                <label >thuong hieu:</label>
                <input type="text" id="thuonghieu" name="thuonghieu"><br><br>
                <label >gia goc :</label>
                <input type="text" id="giagoc" name="giagoc" onkeypress="return isNumberKey(event)"><br><br>
                <label >don gia :</label>
                <input type="text" id="dongia" name="dongia" onkeypress="return isNumberKey(event)"><br><br>
                <label >mo ta :</label>
                <input type="text" id="mota" name="mota"><br><br>
                <label >hinh anh :</label>
                <input type="hidden" id="hinhanh" name="hinhanh"><br><br>
                <img src='' id='image' alt='cloth-image' style=' display:block;width:100px; height:50px'>
                <input type="file" id="file" name="file"><br><br>
                <div class="modal-footer" align="center" style="margin-top:20px">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type='submit'  name='update-sanpham' class='btn-save btn btn-primary' value='save' />
                </div>
            </form>
        </div>
        
        
      </div>
    </div>
  </div>
  <div class="modal" id="addModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
                <label >id san pham:</label>
                <input type="text" id="idsanpham" name="idsanpham" ><br><br>
                <label>loai san pham</label>
                <select name="loaisp" id="loaisp">
                    <?php
                        $get_data = callAPI('GET', 'https://myapiwork.000webhostapp.com/api.php/loaisps', false);
                        $data= json_decode($get_data, true);
                        foreach($data as $i){
                            echo "<option value=$i[idloai]>$i[tenloai]</option>";
                        }
                    ?>
                </select><br><br>
                <label >ten san pham:</label>
                <input type="text" id="tensp" name="tensp"><br><br>
                <label >mau:</label>
                <input type="text" id="mau" name="mau"><br><br>
                <label >size:</label>
                <select name="size" id="size">
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                </select><br><br>
                <label >thuong hieu:</label>
                <input type="text" id="thuonghieu" name="thuonghieu"><br><br>
                <label >gia goc :</label>
                <input type="text" id="giagoc" name="giagoc" onkeypress="return isNumberKey(event)"><br><br>
                <label >don gia :</label>
                <input type="text" id="dongia" name="dongia" onkeypress="return isNumberKey(event)"><br><br>
                <label >mo ta :</label>
                <input type="text" id="mota" name="mota"><br><br>
                <label >hinh anh :</label>
                <input type="file" id="file" name="file"><br><br>
                <div class="modal-footer" align="center" style="margin-top:20px">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type='submit'  name='Submit' class='btn-save btn btn-primary' value='Submit' />
                </div>
            </form>
        </div>
        
        
      </div>
    </div>
  </div>
</html>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    $('.btn-edit').on('click',function(){
        $('#size option:selected').removeAttr('selected');
        let div = $(this).parent().parent();
        id=div.find('.idsanpham').text();
        type=div.find('.loaisp').text();
        name=div.find('.tensp').text();
        color=div.find('.mau').text();
        size=div.find('.size').text();
        thuonghieu=div.find('.thuonghieu').text();
        giagoc=div.find('.giagoc').text();
        dongia=div.find('.dongia').text();
        mota=div.find('.mota').text();
        imgFullURL = $('img.image')[0].src;
        image=div.find('.hinhanh').attr('src');
        
        $('#idsanpham').val(id);
        $('#tensp').val(name);
        $('#loaisp').val(type);
        $('#mau').val(color);
        $('#size option[value='+size+']').attr('selected','selected');
        $('#thuonghieu').val(thuonghieu);
        $('#giagoc').val(giagoc);
        $('#dongia').val(dongia);
        $('#mota').val(mota);
        $('#hinhanh').val(imgFullURL);
        $('#image').attr('src',image);

    })
    $('.btn-delete').on('click',function(){
        let div = $(this).parent().parent();
        id=div.find('.idsanpham').text();
        name=div.find('.tensp').text();
        var check = confirm("Are you sure to delete "+ id +" ?");
        if(check==true){
            fetch('https://myapiwork.000webhostapp.com/api.php/sanphams/' + id +'/delete', {
                method: 'GET',
            })
            location.reload();
            alert('delete success')
        }
    })
</script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    } 
</script>

