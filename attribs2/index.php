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


$ano = '2024';
$co = $user['co_id'];

$atribuidor = Vinculo::getByAnoProf($user['id'], $ano);
$where = ' id_vinculo = "'. $atribuidor->id .'" and tipocod = "'. $tipocod .'"';
$cargoAttri = Cargo::getw($where);

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


$texto = '';
switch ($cargoAttri->tipocod){
   case 'a': 
      $texto = 'Orientação ao Estágio';
      break;
   case 'b': 
      $texto = 'Orientação nas Atividades de aulas práticas em inst da área da saúde';
      break;
   case 'c': 
      $texto = 'Orientação de Trabalhos acadêmicosmicos Obrigatórios (TCCs, dissertações e teses)';
      break;
   case 'd': 
      $texto = 'Orientação de Monitoria';
      break;
}

$funcSelected = '<option >'. $texto .'</option>';

include '../includes/header.php';
echo '<script>
  let co_id = "'. $cargoAttri->co_id_tt .'";
  let tipo = "'. $cargoAttri->tipocod .'";
</script>';

$tpOrientacao = '';
  switch($cargoAttri->tipocod){
   case 'a': 
      $tpOrientacao = 'Orientação ao Estágio ';
      break;
   case 'b': 
      $tpOrientacao = 'Orientação de Aulas Práticas em Saúde';
      break;
   case 'c': 
      $tpOrientacao = 'Orientação à Trabalhos acadêmicos';
      break;
   case 'd': 
      $tpOrientacao = 'Orientação de Monitoria.';
      break;
  }

include __DIR__.'/includes/content.php';
include '../includes/footer.php';
