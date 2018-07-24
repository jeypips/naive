<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../../db.php';

$con = new pdo_db();

$cmcis = $con->getData("SELECT *, DATE_FORMAT(system_log, '%M %d, %Y') system_log FROM cmci");

header("Content-Type: application/json");
echo json_encode($cmcis);

?>