<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();

use \App\Entity\PADAtiv24;

$vinculo = $_GET["vc"];

$where = 'vinculo = "'.$vinculo.'" ';

$registros = PADAtiv24::get($where);

echo json_encode($registros);


