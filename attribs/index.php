<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

/*
if($user['tipo'] != 'prof'){
  header('location: ../home/');
  exit;
}
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

*/

// ['co_id']; 
$co = $user['co_id'];



// const ano = "'. $ano.'";
include '../includes/header.php';
echo '<script>
const ano = "2024";
const co = "'. $co .'";

</script>';

include __DIR__.'/includes/content.php';
include '../includes/footer.php';
