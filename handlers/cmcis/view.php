<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../../db.php';

$con = new pdo_db("cmci");

$cmci = $con->get($_POST['where'],$_POST['model']);

//Municipality
$municipality = $con->getData("SELECT municipality_id, municipality_description FROM municipalities WHERE municipality_id = ".$cmci[0]['municipality']);
$cmci[0]['municipality'] = $municipality[0];

header("Content-Type: application/json");
echo json_encode($cmci[0]);

?>