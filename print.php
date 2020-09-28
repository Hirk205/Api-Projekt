<?php 
include_once("../models/DataProvider.php");
$db=new DataProvider;
if(isset($_POST['print'])){
    
    $sql="SELECT clothes.id, clothes.name, clothes.price, chitiet_hoadon.soluong, chitiet_hoadon.size,hoadon.tinhtrang,hoadon.date  FROM chitiet_hoadon INNER JOIN clothes ON chitiet_hoadon.id_cloth=clothes.id INNER JOIN hoadon ON chitiet_hoadon.MaHD=hoadon.MaHD
    WHERE hoadon.MaHD=$_POST[id_of_user]";
    
    if($db->NumRows($sql)){
        $delimiter = ",";
        $filename = "Bill.csv"; // Create file name
         
        //create a file pointer
        $f = fopen('php://memory', 'w');

        //set column headers
        $fields = array('STT', 'YOUR PRODUCT', 'COUNT(S)', 'PRICES', 'SIZE', 'STATUS','BOUGHT SINCE');
        fputcsv($f, $fields, $delimiter);

        $array=$db->FetchAll($sql);
        $i=1;
        foreach($array as $bill){
           
            $bill['tinhtrang']==0 ? $status="unpaid" : $status="unpaid";
            $bill_money=number_format($bill['price'],0,".",",");
            $lineData = array($i, $bill['name'], $bill['soluong'], $bill_money, $bill['size'],$status,$bill['date']);
            fputcsv($f, $lineData, $delimiter);
            $i++;
        }
        //move back to beginning of file
        fseek($f, 0);
        
        //set headers to download file rather than displayed
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        
        //output all remaining data on a file pointer
        fpassthru($f);              
    }
}
?>   