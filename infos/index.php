<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

$ano = $_SESSION['proecunespar']['year_sel'];
$co =  $_SESSION['proecunespar']['id_coSel'];

if($user['config'] == 1 ){  // coordenador
  // header('location: ./data.php?id='.$co.''.$ano );
  header('location: ./data.php' );
  exit;
}  elseif ($user['config'] == 2 ){ // dir de centro
  header('location: ./lista.php');
  exit;
} elseif ($user['admin'] == 1 ){ // dir de centro
  header('location: ./listaall.php');
  exit;
} else {
  header('location: ../');
  exit;
}

