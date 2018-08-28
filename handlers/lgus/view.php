<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../../db.php';

$con = new pdo_db("lgus");

$lgu = $con->get($_POST['where'],$_POST['model']);

$categories = [
	array("id"=>1,"description"=>"(1) City"),
	array("id"=>2,"description"=>"(2) 1st-2nd Class"),
	array("id"=>3,"description"=>"(3) 3rd-4th Class")
];

$lgu[0]['classification'] = $categories[$lgu[0]['classification']-1];

// Provinces & municipalities
$province = $con->getData("SELECT * FROM provinces WHERE province_id = ".$lgu[0]['province']);
$lgu[0]['province'] = $province[0];

$municipalities = $con->getData("SELECT * FROM municipalities WHERE municipality_province = ".$province[0]['province_id']);
$lgu[0]['province']['municipalities'] = $municipalities;

//Municipality
$municipality = $con->getData("SELECT * FROM municipalities WHERE municipality_id = ".$lgu[0]['municipality']);
$lgu[0]['municipality'] = $municipality[0];

header("Content-Type: application/json");
echo json_encode($lgu[0]);

?>