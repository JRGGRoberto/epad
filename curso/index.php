<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

$ok = false;
if($obUsuario['tipo'] === 'prof'){
   if($obUsuario['config'] === '1'){
      $ok = true;
   }
}
/*
if(!$ok){
   header('location: ../home/');
   exit;
}
*/

include '../includes/header.php';
$uid = $user['id'];
include __DIR__.'/includes/content.php';
include '../includes/footer.php'; 