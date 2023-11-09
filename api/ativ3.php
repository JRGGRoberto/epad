<?php

require '../vendor/autoload.php';

use \App\Entity\Ativ3;

$id_vinc = $_GET["at3"];

$where = 'id_vin = "'.$id_vinc.'"';
$registros = Ativ3::get($where);

echo json_encode($registros);


