
<?php
include_once("call_api.php");

if(isset($_POST['insert'])){
    $data_array =  array(
        "tenloai"        => $_POST["tenloai"],
  );
  $make_call = callAPI('POST', 'http://localhost:8012/api-projekt/api.php/loaisp', json_encode($data_array));
  $response = json_decode($make_call, true);
  $errors   = $response['response']['errors'];
  if($errors) echo $errors;
}
if(isset($_POST['delete'])){
    $data_array =  array(
        "idloai"         =>$_POST['idloai'],
        "tenloai"        => $_POST["tenloai"],
    );
    $update_plan = callAPI('PUT', 'http://localhost:8012/api-projekt/api.php/loaisp?delete=1', json_encode($data_array));
    $response = json_decode($update_plan, true);
    $errors   = $response['response']['errors'];
    if($errors) echo $errors;
}
if(isset($_POST['update'])){
    $data_array =  array(
        "idloai"         =>$_POST['idloai'],
        "tenloai"        => $_POST["tenloai"],
  );
  $update_plan = callAPI('PUT', 'http://localhost:8012/api-projekt/api.php/loaisp', json_encode($data_array));
  $response = json_decode($update_plan, true);
  $errors   = $response['response']['errors'];
  if($errors) echo $errors;
}
//$getSingle="?idloai=1";
$getSingle="";
$get_data=callAPI("GET","http://localhost:8012/api-projekt/api.php/loaisp".$getSingle,false);
$response=json_decode($get_data,true);
//get data api
if($response){
    if(!empty($getSingle)){
        echo "<table>";
        
            echo "<tr>
                    <td>$response[idloai]</td>
                    <td>$response[tenloai]</td>
            </tr>";
        
        echo "</table>";
    }
    else{
    echo "<table>";
    foreach($response as $i){
        echo "<tr>
                <td>$i[idloai]</td>
                <td>$i[tenloai]</td>
        </tr>";
    }
    echo "</table>";
}
}
?>

<form  method = 'post' action='' enctype="multipart/form-data" id='form'>
    <label for="fname">id:</label>
        <input type="text" id="idloai" name="idloai"><br><br>
    <label for="lname">Product Name:</label>
        <input type="text" id="tenloai" name="tenloai"><br><br>
            <input type="submit" value="insert" name="insert">
            <input type="submit" value="delete" name="delete">
            <input type="submit" value="update" name="update">
</form>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    } 
</script>