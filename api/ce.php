<?php

require '../vendor/autoload.php';

use \App\Entity\Centro;

$ca = $_GET["ca"];

$where = 'campus_id = "'.$ca.'"';
$registros = Centro::getRegistros($where);

echo json_encode($registros);
