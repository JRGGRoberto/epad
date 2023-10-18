<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();

use \App\Entity\Campi;

$registros = Campi::getRegistros();
echo json_encode($registros);
