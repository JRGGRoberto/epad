<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

//VALIDAÇÃO DO ID
if(!isset($_GET['t']) ){
   header('location: index.php?status=error');
   exit;
}

$tp_atrib = $_GET['t'];


if($user['tipo'] != 'prof'){
  header('location: ../home/');
  exit;
}
$ok = false;

if($user['tipo'] === 'prof' ){
   $ok = true;
}

if(!$ok){
   header('location: ../home/');
   exit;
}

$ano = '2024';
$co = $user['co_id'];



include '../includes/header.php';
echo '<script>
const ano = "'. $ano.'";
const co = "'. $co .'";
</script>';

include __DIR__.'/includes/content.php';
include '../includes/footer.php';
