<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();

use \App\Entity\Cargo;

$var = $_GET["ca"];

$ano = substr($var, 36, 4);
$id_colegiado = substr($var, 0, 36);

$where = ' (id_colegiado, ano) = ("'.$id_colegiado.'" , "'.$ano.'"  ) ' ;
$order = ' 1 ';

$registros = Cargo::gets($where, $order);
echo json_encode($registros);
