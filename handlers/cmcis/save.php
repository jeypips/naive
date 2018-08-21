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
	
} else {
	
	unset($cmci['id']);	
	
	$insert = $con->insertData($cmci);
	
};

# economy
if ($data['economy']['id']) {
	
	
} else {
	
	
}

?>