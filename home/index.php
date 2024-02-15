<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

if($user['tipo'] == 'agente') {
  header('location: ../matrizes/');
  exit;
} elseif($user['tipo'] == 'prof') {
  // header('location: ../pad/');
  include '../includes/header.php';
  include __DIR__.'/includes/listagem.php';

  include '../includes/footer.php';
   
   
} else {
   header('location: ../login/logout.php');
   exit; 
}


