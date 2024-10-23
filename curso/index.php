<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

$ok = false;
if($user['tipo'] === 'prof' ){
   if($user['config'] == '1'){
      $ok = true;
   }
}

if(!$ok){
   header('location: ../home/');
   exit;
}

use \App\Entity\MatrizDisc;
$ano = $user['AnoAtivo']; //'2024';

// $where = ' (id_curso, ano) = ("'.$user['co_id']. '" , '.$ano.') ' ;
$where = ' id_curso =  "'.$user['co_id']. '" ' ;



$reg = MatrizDisc::get($where);
/*
if(sizeof($reg) == 1){
   header('location: '. '../cursprf/index.php?id='.$reg[0]->id);
   exit;
                        
}
*/

include '../includes/header.php';
$uid = $user['id'];
include __DIR__.'/includes/content.php';
include '../includes/footer.php'; 