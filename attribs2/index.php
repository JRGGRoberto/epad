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

// $where = ("(ano, co_id ) = ('". $ano ."', '".$co ."' ) and aprov_co_id is null" );
$where = ("ano = '". $ano ."' and aprov_co_id is null" );
$order = " campus, colegiado, nome  ";
$profs = Vinculo::gets($where, $order);

$opcoes = '';
$campus = '';
$x = 0;

$hidden = '';

foreach($profs as $p){
   if($user['lota_nome'] != $p->campus) {
      $hidden = ' hidden ';
   } else {
      $hidden = '';
   }
   if($campus !=  $p->campus){
      
      if($x > 0){
        $opcoes .= '</optgroup >';
      }
      $opcoes .= '<optgroup label="'. $p->campus .'"  '. $hidden .' >';
      $campus = $p->campus;
   }
   if($user['co_nome'] != $p->colegiado) {
      $hidden = ' hidden ';
   } else {
      $hidden = '';
   }

   $opcoes .= '<option value="'.$p->id.'"   '. $hidden .'>'.  $p->nome .' - '. strtoupper($p->codcam).'/'.  $p->codcentro .' '. $p->colegiado .'</option>';
   $x++;
}





include '../includes/header.php';
echo '<script>
const ano = "'. $ano.'";
const co = "'. $co .'";

</script>';

include __DIR__.'/includes/content.php';
include '../includes/footer.php';
