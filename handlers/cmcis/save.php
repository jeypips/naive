<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../../db.php';

$con = new pdo_db("cmci");

$cmci = $_POST;

$data = $_POST['data'];

unset($cmci['data']);

$cmci['lgu_id'] = $cmci['lgu_id']['id'];

if ($cmci['id']) {
	
	$update = $con->updateData($cmci,'id');
	$cmci_id = $cmci['id'];
	
} else {
	
	unset($cmci['id']);	
	
	$insert = $con->insertData($cmci);
	$cmci_id = $con->insertId;
	
};

# economy
$con->table = "economy";
if ($data['economy']['id']) {
	
	$update = $con->updateData($data['economy'],'id');
	
} else {

	unset($data['economy']['id']);
	$data['economy']['cmci_id'] = $cmci_id;
	$insert = $con->insertData($data['economy']);

};

# government
$con->table = "government_efficiency";
if ($data['government']['id']) {
	
	$update = $con->updateData($data['government'],'id');
	
} else {

	unset($data['government']['id']);
	$data['government']['cmci_id'] = $cmci_id;
	$insert = $con->insertData($data['government']);

};

# infra
$con->table = "infrastructure";
if ($data['infra']['id']) {
	
	$update = $con->updateData($data['infra'],'id');
	
} else {

	unset($data['infra']['id']);
	$data['infra']['cmci_id'] = $cmci_id;
	$insert = $con->insertData($data['infra']);

};

# resiliency
$con->table = "resiliency";
if ($data['resiliency']['id']) {
	
	$update = $con->updateData($data['resiliency'],'id');
	
} else {

	unset($data['resiliency']['id']);
	$data['resiliency']['cmci_id'] = $cmci_id;
	$insert = $con->insertData($data['resiliency']);

};

?>