<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../../db.php';

$con = new pdo_db();

$lgus = $con->getData("SELECT *, DATE_FORMAT(system_log, '%M %d, %Y') system_log FROM lgus");

foreach ($lgus as $key => $lgu){
	
	$province = $con->getData("SELECT * FROM provinces WHERE province_id = ".$lgu['province']);
	$lgus[$key]['province'] = $province[0];

	$municipality = $con->getData("SELECT municipality_id, municipality_description FROM municipalities WHERE municipality_id = ".$lgu['municipality']);
	$lgus[$key]['municipality'] = $municipality[0];
	
}

header("Content-Type: application/json");
echo json_encode($lgus);

?>