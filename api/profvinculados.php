<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();


use \App\Entity\Vinculo;

$ano = $_GET["y"];

$where = ' ano = '.$ano. ' and disponivel = 1 ';
$order = '  campus, colegiado, nome ';

$registros = Vinculo::gets($where, $order);
echo json_encode($registros);
