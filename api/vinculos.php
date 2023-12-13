<?php

require '../vendor/autoload.php';

//Login::requireLogin();
//use \App\Session\Login;
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use \App\Entity\Vinculo;

$var = $_GET["md"];

$ano = substr($var, 36, 4);
$id_c = substr($var, 0, 36);

$where = ' (id_curso, ano) = ("'.$id_c. '" , '.$ano.') ' ;
$order = ' nome';

$registros = Vinculo::gets($where,$order);
echo json_encode($registros);
