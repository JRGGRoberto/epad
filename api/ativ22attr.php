<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();

use \App\Entity\PADAtiv22;

$ca = $_GET["ca"];
$id_colg = substr($ca, 0, 36);
$ano = substr($ca, 36, 4);
$ativ    = substr($ca, 40, 1);

$where = '(id_co_estudante, atividade, ano) = ("'.$id_colg.'", "'.$ativ.'", "'.$ano.'" ) ';
$order = ' orientador, estudante, serie';

$registros = PADAtiv22::get($where, $order);

echo json_encode($registros);
