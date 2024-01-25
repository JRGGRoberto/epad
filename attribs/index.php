<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();
use \App\Entity\Vinculo;


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

$ano = '2024';
$co = $user['co_id'];

$where = ("(ano, co_id ) = ('". $ano ."', '".$co ."' ) and aprov_co_id is null" );
$order = " nome ";
$profs = Vinculo::gets($where, $order);

$opcoes = '';
foreach($profs as $p){
   $opcoes .= '<option value="'.$p->id.'">'.  $p->nome .'</option>';
}

include '../includes/header.php';
echo '<script>
const ano = "'. $ano.'";
const co = "'. $co .'";
</script>';

include __DIR__.'/includes/content.php';
include '../includes/footer.php';
