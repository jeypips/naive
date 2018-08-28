<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../../db.php';

$con = new pdo_db();

$cmcis = $con->getData("SELECT cmci.id, lgus.lgu_no, cmci.lgu_id, cmci.period_covered, DATE_FORMAT(cmci.system_log, '%M %d, %Y') date_added FROM cmci LEFT JOIN lgus ON cmci.lgu_id = lgus.id");

foreach ($cmcis as $key => $cmci) {
	
	$lgu = $con->getData("SELECT lgus.id, (SELECT municipalities.municipality_description FROM municipalities WHERE municipalities.municipality_id = lgus.municipality) municipality FROM lgus WHERE lgus.id = ".$cmci['lgu_id']);	
	$cmcis[$key]['lgu_id'] = $lgu[0];
	
}

header("Content-Type: application/json");
echo json_encode($cmcis);

?>