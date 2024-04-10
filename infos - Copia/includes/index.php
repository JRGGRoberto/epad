<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();
use \App\Entity\Outros;

echo '<pre>';
print_r($user);
echo '</pre>';

$co_id = '';
if($user['config'] = 1 ){  /// coordenador
  $co_id       = $user['co_id'] ;
  $col_nome    = $user['co_nome'];
  $camp_nome   = $user['lota_nome'];
  $centro_nome = $user['ce_cod'];
  include __DIR__.'/data.php';
} elseif ($user['config'] = 2 ){ // dir de centro
  include '../includes/header.php';
  echo 'coord';
  include '../includes/footer.php';
} else {
    header('location: ../');
    exit;
}


