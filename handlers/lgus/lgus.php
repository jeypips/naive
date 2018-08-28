<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../../db.php';

$con = new pdo_db();

$lgus = $con->getData("SELECT *, DATE_FORMAT(system_log, '%M %d, %Y') system_log FROM lgus");

$categories = array("(1) City","(2) 1st-2nd Class","(3) 3rd-4th Class");

foreach ($lgus as $key => $lgu){
	
	$lgus[$key]['classification'] = $categories[$lgu['classification']-1];
	
	$province = $con->getData("SELECT * FROM provinces WHERE province_id = ".$lgu['province']);
	$lgus[$key]['province'] = $province[0];

	$municipality = $con->getData("SELECT municipality_id, municipality_description FROM municipalities WHERE municipality_id = ".$lgu['municipality']);
	$lgus[$key]['municipality'] = $municipality[0];
	
}

header("Content-Type: application/json");
echo json_encode($lgus);

?>