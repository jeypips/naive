<?php

require_once '../../../db.php';

session_start();

if (!isset($_SESSION['id'])) {
	header('X-Error-Message: Session timeout', true, 500);
	exit();
};

$con = new pdo_db("users");

$user = $con->get(["id"=>$_SESSION['id']],["name"]);

$avatar = "angular/modules/account/avatar.png";

$profile = array(
	"name"=>$user[0]['name'],
	"picture"=>$avatar,
);

echo json_encode($profile);

?>