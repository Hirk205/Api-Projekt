<?php
    $item_array= array("x"=>"1", "y"=>"2", "z"=>"3");
    $array['cart']['0']= $item_array;
    $array['cart']['1']= $item_array;
    $item_array= array("x"=>"1", "y"=>"2", "z"=>"3");
    array_push($array['cart'], $item_array );
    array_push( $item_array, $array['cart'] );
   
    $json=json_encode($item_array);
    $obj=json_decode($json,true);
    print_r($obj);
    echo "<br>";
    foreach($obj[0] as $i=>$dem){
        $tong=$dem['z']*$dem['y'];
        echo $tong;
    }
?>