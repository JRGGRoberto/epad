<?php

require '../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();
use \App\Entity\Vinculo;

if($user['tipo'] != 'prof') {
    header('location: ../matrizes/');
    exit;
}

$idprof = $user['id'];
$vinc = Vinculo::getByAnoProf($idprof, '2024');

include '../includes/header.php';
if(!$vinc == null){
    include __DIR__.'/includes/listagem.php';
    
} else {
    include __DIR__.'/includes/msgnovinc.php';
    
}


include '../includes/footer.php';


