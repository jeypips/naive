<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../../db.php';

session_start();

$con = new pdo_db();

$lgus = $con->getData("SELECT lgus.id, (SELECT municipality_description FROM municipalities WHERE municipalities.municipality_id = lgus.municipality) municipality FROM lgus");

header("Content-Type: application/json");
echo json_encode($lgus);

?>