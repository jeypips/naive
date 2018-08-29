<?php

$response = array("exists"=>file_exists("cmci.xlsx"));

echo json_encode($response);

?>