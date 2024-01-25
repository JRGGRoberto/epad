<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();

use \App\Entity\Vinculo;

$var = $_GET["md"];

$ano = substr($var, 36, 4);
$id_c = substr($var, 0, 36);

$where = ' (id_curso, ano) = ("'.$id_c. '" , '.$ano.') ' ;
$order = ' nome';

$registros = Vinculo::gets($where,$order);
echo json_encode($registros);
