<?php

require '../vendor/autoload.php';

use \App\Entity\PADAtiv4;

$vinculo = $_GET["at4"];

$where = 'vinculo = "'.$vinculo.'"';

$registros = PADAtiv4::get($where);

echo json_encode($registros);


