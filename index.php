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

    echo '<pre>';
    print_r($user);
    echo '</pre>';

$idprof = $user['id'];
$vinc = Vinculo::getByAnoProf($idprof, '2024');

if($vinc == null){
    echo 'nada';
    exit;
}
echo '<pre>';
print_r($vinc);
echo '</pre>';


include '../includes/header.php';
if(!$vinc instanceof Vinculo){
    $vinc = $vinc;
    include __DIR__.'/includes/listagem.php';
} else {
    echo 'Seu vinculo com o ano letivo de 2024 ainda não foi realizado, favor entrar em contato com o seu coordenador.';
}


include '../includes/footer.php';


