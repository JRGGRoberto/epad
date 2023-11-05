<?php

require '../vendor/autoload.php';

//Login::requireLogin();
//use \App\Session\Login;

use \App\Entity\MatrizDisc;

$var = $_GET["md"];

$ano = substr($var, 36, 4);
$id_c = substr($var, 0, 36);

$where = ' (id_curso, ano) = ("'.$id_c. '" , '.$ano.') ' ;
$order = ' ano desc ';

$registros = MatrizDisc::get($where,$order);
echo json_encode($registros);
