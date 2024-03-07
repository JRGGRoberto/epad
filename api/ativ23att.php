<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();

use \App\Entity\PADAtiv23;

$var = $_GET["ca"];

$ano = substr($var, 36, 4);
$id_co = substr($var, 0, 36);

$where = ' (ano, id_co) = ('.$ano.' , "'. $id_co .'") ';

$registros = PADAtiv23::get($where);

echo json_encode($registros);


