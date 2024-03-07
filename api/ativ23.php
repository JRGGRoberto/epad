<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();

use \App\Entity\PADAtiv23;

$vinculo = $_GET["vc"];

$where = 'vinculo = "'.$vinculo.'" ';

$registros = PADAtiv23::get($where);

echo json_encode($registros);


