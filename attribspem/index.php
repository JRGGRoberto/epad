<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();
use \App\Entity\Vinculo;
use \App\Entity\Cargo;

if($user['tipo'] != 'prof'){
  header('location: ../home/');
  exit;
}
$ok = false;

if($user['tipo'] === 'prof' ){
  // if($user['config'] == '1'){
      $ok = true;
  // }
}
$tipocod = $_GET['t'];
if(!$ok){
   header('location: ../home/');
   exit;
}


$ano = $_SESSION['proecunespar']['year_sel'];
$co =  $_SESSION['proecunespar']['id_coSel'];


include '../includes/header.php';
echo '<script>
  let co_id = "'. $co .'";
  let ano = "'. $ano .'";
</script>';


include __DIR__.'/includes/content.php';

include '../includes/footer.php';

