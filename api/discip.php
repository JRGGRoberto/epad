<?php

require '../vendor/autoload.php';

use \App\Entity\Disciplinas;

$c = $_GET["mat"];

$where = 'id_matriz = "'.$c.'"';
$registros = Disciplinas::get($where);

echo json_encode($registros);


