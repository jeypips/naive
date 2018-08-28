<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../../db.php';

$con = new pdo_db("cmci");

$cmci = $con->get(array("id"=>$_POST['id']),array("id","lgu_id","period_covered"));

$lgu = $con->getData("SELECT lgus.id, (SELECT municipalities.municipality_description FROM municipalities WHERE municipalities.municipality_id = lgus.municipality) municipality FROM lgus WHERE lgus.id = ".$cmci[0]['lgu_id']);
$cmci[0]['lgu_id'] = $lgu[0];

$cmci[0]['data'] = [];
// $cmci[0]['data']['economy'] = [];
$cmci[0]['data']['economy']['id'] = 0;
// $cmci[0]['data']['government'] = [];
$cmci[0]['data']['government']['id'] = 0;
// $cmci[0]['data']['infra'] = [];
$cmci[0]['data']['infra']['id'] = 0;
// $cmci[0]['data']['resiliency'] = [];
$cmci[0]['data']['resiliency']['id'] = 0;

$con->table = "economy";
$economy = $con->get(array("cmci_id"=>$cmci[0]['id']),["id","local_economy_size","local_economy_growth","local_economy_structure","safety_compliant_business","increase_in_employment","cost_of_living","cost_of_doing_business","financial_deepening","productivity","presence_of_business_and_professional"]);
if (count($economy)) {
	$cmci[0]['data']['economy'] = $economy[0];
};

$con->table = "government_efficiency";
$government = $con->get(array("cmci_id"=>$cmci[0]['id']),["id","compliance_to_national_directives","investment_promotion_unit","registration_efficiency","generate_local_resource","capacity_of_health_services","capacity_of_school_services","recognition_of_performance","business_permits_and_licensing","peace_and_order","social_protection"]);
if (count($government)) {
	$cmci[0]['data']['government'] = $government[0];
};

$con->table = "infrastructure";
$infra = $con->get(array("cmci_id"=>$cmci[0]['id']),["id","road_network","distance_to_ports","availability_of_basic_utilities","transportation_vehicles","education","health","lgu_investment","accommodation_capacity","information_technology_capacity","financial_technology_capacity"]);
if (count($infra)) {
	$cmci[0]['data']['infra'] = $infra[0];
};

$con->table = "resiliency";
$resiliency = $con->get(array("cmci_id"=>$cmci[0]['id']),["id","land_use_plan","disaster_risk_reduction_plan","annual_disaster_drill","early_warning_system","budget_for_drrmp","local_risk_assessments","emergency_infrastructure","utilities","employed_population","sanitary_system"]);
if (count($resiliency)) {
	$cmci[0]['data']['resiliency'] = $resiliency[0];
};

header("Content-Type: application/json");
echo json_encode($cmci[0]);

?>