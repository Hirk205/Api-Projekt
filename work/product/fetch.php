<?php

//fetch.php

$api_url = "http://localhost:8012/api-projekt/api/Product/productAction.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);

$output = '';

if($result)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row->idsanpham.'</td>
			<td>'.$row->loaisanpham.'</td>
			<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->idsanpham.'">Edit</button></td>
			<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->idsanpham.'">Delete</button></td>
		</tr>
		';
	}
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