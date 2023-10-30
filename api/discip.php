<?php

require '../vendor/autoload.php';

use \App\Entity\Disciplinas;

$c = $_GET["c"];

$where = 'id_curso = "'.$c.'"';
$registros = Disciplinas::get($where);

echo json_encode($registros);
