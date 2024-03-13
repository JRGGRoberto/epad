<?php

require '../vendor/autoload.php';

use \App\Session\Login;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Obriga o usuário a estar logado
Login::requireLogin();
$user = Login::getUsuarioLogado();

use \App\Entity\Horas;


// Cláusula WHERE
$where = '';
$order = 'horaexp';


$horass = Horas::gets();
$resultados = '';
$h = '';
foreach($horass as $hs){
   if($h <> $hs->horaexp){
    $resultados .= '<hr>Hora semanal correspondente: '. $hs->horaexp .'h <br><br>';
    $h = $hs->horaexp;
   }
   $resultados .= '<span class="a">'. $hs->horamatz .'</span>';

}


include '../includes/header.php';
include __DIR__.'/includes/listagem.php';
include '../includes/footer.php'; 
