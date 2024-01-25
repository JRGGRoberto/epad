<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();

use \App\Entity\PADAtiv3;

$vinculo = $_GET["at3"];

$where = 'vinculo = "'.$vinculo.'"';

$registros = PADAtiv3::get($where);

echo json_encode($registros);


