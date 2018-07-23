<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../../db.php';

$con = new pdo_db("lgus");

$data = $_POST;

if ($data['id']) {
	
	$lgu = $con->updateObj($data,'id');
	
} else {
	
	unset($data['id']);	
	
	$lgu = $con->insertObj($data);
	
};

?>