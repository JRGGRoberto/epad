<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

if($user['config'] == 1 ){  // coordenador
  header('location: ./data.php?id='.$user['co_id']);
  exit;
}  elseif ($user['config'] == 2 ){ // dir de centro
  header('location: ./lista.php');
  exit;
} else {
  header('location: ../');
  exit;
}

