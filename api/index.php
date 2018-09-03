<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once 'vendor/autoload.php';
require_once '../db.php';
require_once 'mapper.php';
require_once 'classes.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$container = new \Slim\Container;
$app = new \Slim\App($container);

$container = $app->getContainer();
$container['con'] = function ($container) {
	$con = new pdo_db();
	return $con;
};

$app->get('/datasets/{period}', function (Request $request, Response $response, array $args) {

	$con = $this->con;

	global $pillars;

	$period = $args['period'];		

	$categories = array("(1) City","(2) 1st-2nd Class","(3) 3rd-4th Class");
		
	$cmcis = $con->getData("SELECT cmci.id, lgus.lgu_no, (SELECT provinces.province_description FROM provinces WHERE provinces.province_id = lgus.province) province, (SELECT municipalities.municipality_description FROM municipalities WHERE municipalities.municipality_id = lgus.municipality) lgu, lgus.classification category FROM cmci LEFT JOIN lgus ON cmci.lgu_id = lgus.id WHERE cmci.period_covered = '$period'");

	foreach ($cmcis as $i => $cmci) {

		$cmcis[$i]['category'] = $categories[$cmci['category']-1];

		foreach ($pillars as $key => $pillar) {

			foreach ($pillar as $p => $v) {
				
				$sql = "SELECT $v FROM $key WHERE cmci_id = ".$cmci['id'];
				$actual = $con->getData($sql);
				$actual_value = (count($actual))?$actual[0][$v]:0;

				$cmcis[$i][$key][$v]['actual'] = $actual_value;
				$cmcis[$i][$key][$v]['rank'] = 0;
				$cmcis[$i][$key][$v]['competitive'] = 0;
				
			};

		};

	};	
	
	$dataset = new dataset($cmcis,$pillars);
	
    // return $response->withJson($cmcis);
	// $dataset->get();
	// $dataset->pillars();
    return $response->withJson($dataset->get());

});

$app->run();

?>