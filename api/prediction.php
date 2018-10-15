<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once '../db.php';
require_once 'mapper.php';
require_once 'classes.php';

$period = $_POST['period'];
$top = intval($_POST['top']);
$prediction_category = intval($_POST['category']);
$prediction_indicators = json_decode($_POST['indicators'], true);

require_once '../handlers/predictions/prediction.php';

header("Content-Type: application/json");
echo json_encode($prediction);

?>