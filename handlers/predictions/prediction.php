<?php

$con = new pdo_db();

$con->table = "datasets";
$check_dataset = $con->get(array("period"=>"'$period'","top"=>$top));
if (count($check_dataset)) {
	
	$dataset_response = $check_dataset[0]['dataset'];
	$prediction = array("headers"=>$headers,"dataset"=>json_decode($dataset_response,true));	
	
} else {

	$categories = array("(1) City","(2) 1st-2nd Class","(3) 3rd-4th Class");

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

	# cache datasets results		
	$cache_dataset = $con->insertData(array("period"=>$period,"top"=>$top,"dataset"=>json_encode($dataset_response),"system_log"=>"CURRENT_TIMESTAMP"));
	#

	$prediction = array("headers"=>$headers,"dataset"=>$dataset_response);

}

?>