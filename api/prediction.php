<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../db.php';
require_once 'mapper.php';
require_once 'classes.php';

$period = $_POST['period'];
$top = intval($_POST['top']);

$categories = array("(1) City","(2) 1st-2nd Class","(3) 3rd-4th Class");

$con = new pdo_db();

$cmcis = $con->getData("SELECT cmci.id, lgus.lgu_no, (SELECT provinces.province_description FROM provinces WHERE provinces.province_id = lgus.province) province, (SELECT municipalities.municipality_description FROM municipalities WHERE municipalities.municipality_id = lgus.municipality) lgu, lgus.classification category FROM cmci LEFT JOIN lgus ON cmci.lgu_id = lgus.id WHERE cmci.period_covered = '$period'");

foreach ($cmcis as $i => $cmci) {

	$cmcis[$i]['category'] = $categories[$cmci['category']-1];

	foreach ($pillars as $key => $pillar) {
	
		$pillar_total = 0;
	
		foreach ($pillar as $p => $v) {
			
			if ($v == "total") continue;
			
			$sql = "SELECT $v FROM $key WHERE cmci_id = ".$cmci['id'];
			$actual = $con->getData($sql);
			$actual_value = (count($actual))?$actual[0][$v]:0;
			
			$cmcis[$i][$key][$v]['actual'] = $actual_value;
			$cmcis[$i][$key][$v]['rank'] = 0;
			$cmcis[$i][$key][$v]['competitive'] = 0;

			$pillar_total = $pillar_total + ($actual_value*2.5);
			
		};

		$cmcis[$i][$key]['total']['actual'] = $pillar_total;
		$cmcis[$i][$key]['total']['rank'] = 0;
		$cmcis[$i][$key]['total']['competitive'] = 0;		
		
	};

};

$dataset_response = [];
if (count($cmcis)) {
	$dataset = new dataset($cmcis,$pillars);
	$dataset_response = $dataset->get($top);
};

$prediction = array("headers"=>$headers,"dataset"=>$dataset_response);

header("Content-Type: application/json");
echo json_encode($prediction);

?>