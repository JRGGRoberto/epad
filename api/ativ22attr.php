<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();

use \App\Entity\PADAtiv22;

$ca = $_GET["ca"];
$id_colg = substr($ca, 0, 36);
$ativ    = substr($ca, 36, 1);

$where = '(id_co_estudante, atividade) = ("'.$id_colg.'", "'.$ativ.'") ';
$order = ' orientador, estudante, serie';

$registros = PADAtiv22::get($where, $order);

echo json_encode($registros);
