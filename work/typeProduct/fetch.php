<?php

//fetch.php

$api_url = "http://localhost:8012/api-projekt/api/typeProduct/typeProductAction.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);

$output = '';

if($result)
{   
    $output .= '<label>Pick a type :</label>
                    <select id="loaisp" name="loaisp">';
	foreach($result as $row)
	{
		$output .='<option value='.$row->idloai.'>'.$row->tenloai.'</option>';
    }
    $output .='        </select>';
}
else
{
	$output .= '
	<tr>
		<td colspan="4" align="center">No Data Found</td>
	</tr>
	';
}

echo $output;

?>