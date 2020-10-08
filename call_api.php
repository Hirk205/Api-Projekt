<?php
function get($url){
   $data=file_get_contents($url);
   return $data;
}

function post($url,$postData){
   $ch = curl_init();
   $headers = array(
      'Content-Type: application/json'
   );
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_VERBOSE, 1);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
   curl_setopt($ch, CURLOPT_URL, $url);
   $result = curl_exec($ch);
   $ch_error = curl_error($ch);

   if ($ch_error) {

      echo"ERROR";
      curl_close($ch);

   } else {
      curl_close($ch);
      return $result;
   }
   
}
function put($url,$putData){

   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL,$url);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($putData));
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   
   $result = curl_exec($ch);
   curl_close($ch);
   
   return $result;
}

function delete($url){
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL,$url);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   $result = curl_exec($ch);
   $result = json_decode($result);
   curl_close($ch);
   return $result;
}

?>