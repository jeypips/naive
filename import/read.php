<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require '../phpspreadsheet/vendor/autoload.php';
require_once '../db.php';
require_once 'mapper.php';

$con = new pdo_db();

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$inputFileName = "cmci.xlsx";

$reader = new Xlsx();
$spreadsheet = $reader->load($inputFileName);
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

$row = [];

foreach ($sheetData as $i => $data) {

	if ($i<3) continue;
	
	if ($data['A']!=null) {
	
	$migrate = array(
		"cmci"=>array(
			"lgu_id"=>getLguId($con,$data[$map['lgu_no']]),
			"period_covered"=>$_POST['period'],
			"system_log"=>"CURRENT_TIMESTAMP",
		),
		"economy"=>array(
			"local_economy_size"=>$data[$map['local_economy_size']],
			"local_economy_growth"=>$data[$map['local_economy_growth']],
			"local_economy_structure"=>$data[$map['local_economy_structure']],
			"safety_compliant_business"=>$data[$map['safety_compliant_business']],
			"increase_in_employment"=>$data[$map['increase_in_employment']],
			"cost_of_living"=>$data[$map['cost_of_living']],
			"cost_of_doing_business"=>$data[$map['cost_of_doing_business']],
			"financial_deepening"=>$data[$map['financial_deepening']],
			"productivity"=>$data[$map['productivity']],
			"presence_of_business_and_professional"=>$data[$map['presence_of_business_and_professional']],
			"system_log"=>"CURRENT_TIMESTAMP",
		),
		"government_efficiency"=>array(
			"compliance_to_national_directives"=>$data[$map['compliance_to_national_directives']],
			"investment_promotion_unit"=>$data[$map['investment_promotion_unit']],
			"registration_efficiency"=>$data[$map['registration_efficiency']],
			"generate_local_resource"=>$data[$map['generate_local_resource']],
			"capacity_of_health_services"=>$data[$map['capacity_of_health_services']],
			"capacity_of_school_services"=>$data[$map['capacity_of_school_services']],
			"recognition_of_performance"=>$data[$map['recognition_of_performance']],
			"business_permits_and_licensing"=>$data[$map['business_permits_and_licensing']],
			"peace_and_order"=>$data[$map['peace_and_order']],
			"social_protection"=>$data[$map['social_protection']],
			"system_log"=>"CURRENT_TIMESTAMP",		
		),
		"infrastructure"=>array(
			"road_network"=>$data[$map['road_network']],
			"distance_to_ports"=>$data[$map['distance_to_ports']],
			"availability_of_basic_utilities"=>$data[$map['availability_of_basic_utilities']],
			"transportation_vehicles"=>$data[$map['transportation_vehicles']],
			"education"=>$data[$map['education']],
			"health"=>$data[$map['health']],
			"lgu_investment"=>$data[$map['lgu_investment']],
			"accommodation_capacity"=>$data[$map['accommodation_capacity']],
			"information_technology_capacity"=>$data[$map['information_technology_capacity']],
			"financial_technology_capacity"=>$data[$map['financial_technology_capacity']],
			"system_log"=>"CURRENT_TIMESTAMP",		
		),
		"resiliency"=>array(
			"land_use_plan"=>$data[$map['land_use_plan']],
			"disaster_risk_reduction_plan"=>$data[$map['disaster_risk_reduction_plan']],
			"annual_disaster_drill"=>$data[$map['annual_disaster_drill']],
			"early_warning_system"=>$data[$map['early_warning_system']],
			"budget_for_drrmp"=>$data[$map['budget_for_drrmp']],
			"local_risk_assessments"=>$data[$map['local_risk_assessments']],
			"emergency_infrastructure"=>$data[$map['emergency_infrastructure']],
			"utilities"=>$data[$map['utilities']],
			"employed_population"=>$data[$map['employed_population']],
			"sanitary_system"=>$data[$map['sanitary_system']],
			"system_log"=>"CURRENT_TIMESTAMP",			
		),
	);
	
	$rows[] = $migrate;
	 
	};

};

function getLguId($con,$no) {
	
	$id = null;
	
	$sql = "SELECT id FROM lgus WHERE lgu_no = ".$no;

	$lgu_id = $con->getData($sql);
	
	if (count($lgu_id)) {
		
		$id = $lgu_id[0]['id'];
		
	};
	
	return $id;
	
};

echo json_encode($rows);

?>