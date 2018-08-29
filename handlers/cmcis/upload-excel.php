<?php

$dir = "../../import/";

move_uploaded_file($_FILES['file']['tmp_name'],$dir."cmci.xlsx");

?>