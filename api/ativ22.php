<?php

require '../vendor/autoload.php';

use \App\Entity\PADAtiv22;

$vinculo = $_GET["vc"];

$where = 'vinculo = "'.$vinculo.'"';

$registros = PADAtiv22::get($where);

echo json_encode($registros);


