<?php

require '../phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$inputFileName = "cmci.xlsx";

$reader = new Xlsx();
$spreadsheet = $reader->load($inputFileName);
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

$row = [];

foreach ($sheetData as $i => $data) {

	if ($i<3) continue;
	
	if ($data['A']!=null) $rows[] = $data;

};

echo json_encode($rows);

?>