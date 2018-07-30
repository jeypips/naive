<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../../db.php';

$con = new pdo_db();

$municipalities = $con->getData("SELECT * FROM municipalities WHERE municipality_province = ".$_POST['province_id']);

echo json_encode($municipalities);

?>