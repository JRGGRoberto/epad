<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();

use \App\Entity\CnpqArea;

$ga = $_GET["ga"];
$where = ' id_garea = '.$ga;
$order = 'nome';

$registros = CnpqArea::getRegistros($where,$order);
echo json_encode($registros);
