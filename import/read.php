<?php

require '../phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$inputFileName = "cmci.xlsx";

$reader = new Xlsx();
$spreadsheet = $reader->load($inputFileName);
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

foreach ($sheetData as $i => $data) {
	
	if ($i<3) continue;
	if ($i>3) break;	

	var_dump($data);

};

// var_dump($sheetData);

?>