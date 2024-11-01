<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();
use \App\Entity\Vinculo;

if($user['tipo'] != 'prof') {
    header('location: ../matrizes/');
    exit;
}

$ano = $_GET["ano"];

$idprof = $user['id'];
$vinc = Vinculo::getByAnoProf($idprof, $ano);


$editavel = true;

include '../includes/header.php';
if(!$vinc == null){

    if(($vinc->aprov_co_id == null) or ($vinc->aprov_co_id == '') ){
        $editavel = true;
    } else {
        $editavel = false;
    }

    include __DIR__.'/includes/listagem.php';

    
} else {
    include __DIR__.'/includes/msgnovinc.php';
    
}


include '../includes/footer.php';


