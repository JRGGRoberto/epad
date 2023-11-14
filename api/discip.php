<?php

require '../vendor/autoload.php';

use \App\Entity\Disciplinas;

$c = $_GET["mat"];

$where = 'id_matriz = "'.$c.'"';
$order = 'serie, nome ';

$registros = Disciplinas::get($where, $order, null);

echo json_encode($registros);


