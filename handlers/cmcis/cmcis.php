<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../../db.php';

$con = new pdo_db();

$cmcis = $con->getData("SELECT *, DATE_FORMAT(system_log, '%M %d, %Y') system_log FROM cmci");

foreach ($cmcis as $key => $cmci){
	
	$lgu = $con->getData("SELECT lgus.id, (SELECT municipalities.municipality_description FROM municipalities WHERE municipalities.municipality_id = lgus.municipality) municipality FROM lgus WHERE lgus.id = ".$cmci['lgu_id']);	
	$cmcis[$key]['lgu_id'] = $lgu[0];
	
}

header("Content-Type: application/json");
echo json_encode($cmcis);

?>