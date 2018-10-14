<?php

$con = new pdo_db();

$con->table = "predictions";
$check_prediction = $con->get(array("period"=>"'$period'","top"=>$top));
if (count($check_prediction)) {
	
	$prediction_response = $check_prediction[0]['prediction'];
	$prediction_data = json_decode($prediction_response,true);
	
} else {

	$categories = array("(1) City","(2) 1st-2nd Class","(3) 3rd-4th Class");

	$cmcis = $con->getData("SELECT cmci.id, lgus.lgu_no, (SELECT provinces.province_description FROM provinces WHERE provinces.province_id = lgus.province) province, (SELECT municipalities.municipality_description FROM municipalities WHERE municipalities.municipality_id = lgus.municipality) lgu, lgus.classification cat_no, lgus.classification category FROM cmci LEFT JOIN lgus ON cmci.lgu_id = lgus.id WHERE cmci.period_covered = '$period'");

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

	$prediction_data = array("dataset"=>$dataset_response);
	# cache prediction results
	$cache_prediction = $con->insertData(array("period"=>$period,"top"=>$top,"prediction"=>json_encode($prediction_data),"system_log"=>"CURRENT_TIMESTAMP"));
	#

};

$prediction = array("headers"=>$headers,"prediction"=>$prediction_data,"year"=>$period);

# frequency tables
$frequency_tables = new frequency_tables($prediction['prediction']['dataset'],$pillars,$headers);
$frequencies = $frequency_tables->get_frequencies();

$prediction['prediction']['frequency_tables'] = $frequencies;

# likelihood tables
$likelihood_tables = new likelihood_tables($prediction['prediction']['dataset'],$pillars,$headers);
$likelihoods = $likelihood_tables->get_likelihoods();

$prediction['prediction']['likelihood_tables'] = $likelihoods;

# probabilities
$probabilities = new probabilities($likelihoods,$pillars);
$probabilities_data = $probabilities->get_probabilities();

$prediction['prediction']['probabilities'] = $probabilities_data;

$conditional_probabilities = new conditional_probabilities($probabilities_data,$pillars);
$conditional_probabilities_data = $conditional_probabilities->get_conditional_probabilities();

$prediction['prediction']['conditional_probabilities'] = $conditional_probabilities_data;

$normalize_probabilities = new normalize_probabilities($conditional_probabilities_data,$pillars);
$normalize_probabilities_data = $normalize_probabilities->get_normalized_probabilities();

$prediction['prediction']['normalized_probabilities'] = $normalize_probabilities_data;

$classifier = new classifier($likelihoods,$pillars,$prediction_category,$prediction_indicators);
$classified = $classifier->get_classifed();
$results = $classifier->get_results();
$normalized_results = $classifier->normalize();
$prediction_result = $classifier->prediction();

$prediction['prediction']['classified'] = $classified;
$prediction['prediction']['results'] = $results;
$prediction['prediction']['normalized_results'] = $normalized_results;
$prediction['prediction']['prediction_result'] = $prediction_result;

// echo json_encode($classified);
// echo json_encode($results);
// echo json_encode($normalized_results);
// echo json_encode($prediction_result);
// exit();

?>