<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../../db.php';

$con = new pdo_db("cmci");

$data = $_POST;

if ($data['id']) {
	
	$cmci = $con->updateObj($data,'id');
	
} else {
	
	unset($data['id']);	
	
	$cmci = $con->insertObj($data);
	
};

?>