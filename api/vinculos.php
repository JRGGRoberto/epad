<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();

use \App\Entity\Vinculo;

$var = $_GET["md"];

$ano = substr($var, 36, 4);
$id_c = substr($var, 0, 36);
$mostarDisponiveis = '';

$where = '';
if(strlen($var) > 40){
    $mostarDisponiveis = substr($var, 40, 1);
    if($mostarDisponiveis == 'd'){
        $where = ' ( co_id , ano, disponivel ) = ("'.$id_c. '" , '.$ano.', "1" ) ' ;
    }
} else {
    $where = ' (co_id , ano) = ("'.$id_c. '" , '.$ano.') ' ;
}

$registros = Vinculo::gets($where,$order);
echo json_encode($registros);
