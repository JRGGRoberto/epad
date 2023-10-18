<?php

require '../vendor/autoload.php';

use \App\Entity\Colegiado;

$ce = $_GET["ce"];

$where = 'centro_id = "'.$ce.'"';
$registros = Colegiado::getRegistros($where);

echo json_encode($registros);
