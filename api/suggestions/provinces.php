<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../../db.php';

session_start();

$con = new pdo_db();

$provinces = $con->getData("SELECT * FROM provinces");

foreach ($provinces as $key => $province){		

	$municipalities = $con->getData("SELECT municipality_id, municipality_description FROM municipalities WHERE municipality_province = ".$province['province_id']);
	$provinces[$key]['municipalities'] = $municipalities;	

};

header("Content-Type: application/json");
echo json_encode($provinces);

?>