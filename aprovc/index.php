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


$ano = '2024';
$co = $user['co_id'];



include '../includes/header.php';
echo '<script>
const ano = "'. $ano.'";
const co = "'. $co .'";
</script>';

include __DIR__.'/includes/content.php';
include '../includes/footer.php';
