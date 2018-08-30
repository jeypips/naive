<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../db.php';

$con = new pdo_db("cmci");

$data = $_POST['import'];

$check_cmci = $con->get(array("lgu_id"=>$data['cmci']['lgu_id'],"period_covered"=>"'".$data['cmci']['period_covered']."'"));

if (count($check_cmci)==0) {

	# cmci
	$cmci = $con->insertData($data['cmci']);
	$cmci_id = $con->insertId;

	# economy
	$con->table = "economy";
	$data['economy']['cmci_id'] = $cmci_id;
	$economy = $con->insertData($data['economy']);
	
	# government
	$con->table = "government_efficiency";
	$data['government_efficiency']['cmci_id'] = $cmci_id;	
	$government_efficiency = $con->insertData($data['government_efficiency']);
	
	# infra
	$con->table = "infrastructure";
	$data['infrastructure']['cmci_id'] = $cmci_id;	
	$infrastructure = $con->insertData($data['infrastructure']);

	# resiliency
	$con->table = "resiliency";
	$data['resiliency']['cmci_id'] = $cmci_id;	
	$resiliency = $con->insertData($data['resiliency']);	

};

?>