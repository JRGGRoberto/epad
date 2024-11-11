<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

//VALIDAÇÃO 


$ok = false;
$subTitle = 'aa';

if($user['tipo'] === 'prof' ){
   $ok = true;
}

if(in_array($user['config'], [1, 2]) ){
   $user['config'] == 1 ? $subTitle ='Coordenação' : $subTitle = 'Centro de Área';
   $ok = true;
} 


if(!$ok){
   header('location: ../home/');
   exit;
}


$ano = $_SESSION['proecunespar']['year_sel'];
$co =  $_SESSION['proecunespar']['id_coSel'];

$ce = $user['ce_id'];



include '../includes/header.php';
if ($user['config'] == 1){
   echo '<script>
         const ano = "'. $ano.'";
         const co = "'. $co .'";
         </script>';
   // include __DIR__.'/includes/contentco.php';
   include './includes/contentco.php';
} elseif ($user['config'] == 2){
   echo '<script>
         const ano = "'. $ano.'";
         const ce = "'. $ce .'";
         </script>';
   include __DIR__.'/includes/contentce.php';
} else {
   echo 'Não autorizado';
}

include '../includes/footer.php';