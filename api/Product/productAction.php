<?php

//test_api.php

include('../Api.php');

$api_object = new API();

if($_GET["action"] == 'fetch_all')
{
	$query = "	SELECT sp.idsanpham, lsp.tenloai as loaisanpham, sp.tensp, sp.mau, sp.size, sp.thuonghieu, sp.giagoc, sp.dongia, sp.mota, sp.hinhanh
				FROM sanpham sp INNER JOIN loaisp lsp
				WHERE sp.loaisp=lsp.idloai";
	$data = $api_object->fetch_all($query);
}

if($_GET["action"] == 'insert')
{
	$data = $api_object->insert();
}

if($_GET["action"] == 'fetch_single')
{
	$data = $api_object->fetch_single($_GET["id"]);
}

if($_GET["action"] == 'update')
{
	$data = $api_object->update();
}

if($_GET["action"] == 'delete')
{
	$data = $api_object->delete($_GET["id"]);
}

echo json_encode($data);

?>