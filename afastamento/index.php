<?php
require '../vendor/autoload.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();
use \App\Entity\Colegiado;

use \App\Entity\Outros;

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



include '../includes/header.php';

$colegiado = Colegiado::getRegistro($user['id_coSel']);


$coleg =  $user['co_id'];
$anoQ =  $user['year_sel'] ;

$qry = '
select 
  v.nome, v.id, p.modalidade, p.tipo, p.portaria, p.ch, p.dt_inicio, p.dt_fim, v.disponivel 
from 
   vinculov v
   inner join pad24 p on v.id  = p.vinculo  and v.ano = '. $anoQ .'
where v.co_id  = "'. $coleg.'" ';

$lista = Outros::qry($qry);

$listaAfastados = '';
function formaData($dt){
   return substr($dt,8,2) .'/'.substr($dt,5,2) .'/'.substr($dt,0,4) ;
}

foreach($lista as $af){
   $modalidade = '';
   switch($af->modalidade){
     case '10': 
       $modalidade = 'Médico';
        break;
     case '20':
       $modalidade = 'Mestrado';
        break; 
     case '21':
       $modalidade = 'Doutorado';
        break; 
     case '21':
      $modalidade = 'Pós-Doutorado';
       break; 
   }

   $tipo = '';
   switch($af->tipo){
     case 't': 
       $tipo = 'Total';
        break;
     case 'p': 
       $tipo = 'Parcial';
         break;
   }

   $disponivel = '';
   switch($af->disponivel){
     case 1: 
       $disponivel = '⛔';
        break;
     case 0: 
       $disponivel = '🔒';
         break;
   }

   $listaAfastados .= '<tr>';
      $listaAfastados .= '<td>'. $af->nome .'</td>';
      $listaAfastados .= '<td> <a href="../padstoprn/index.php?id='. $af->id .'" target="_blank">📄</a></td>';
      $listaAfastados .= '<td>'. $modalidade .'</td>';
      $listaAfastados .= '<td></td>';
      $listaAfastados .= '<td>'. $af->portaria .'</td>';
      $listaAfastados .= '<td>'. $af->ch .'</td>';
      $listaAfastados .= '<td>'. formaData($af->dt_inicio) .'</td>';
      $listaAfastados .= '<td>'. formaData($af->dt_fim) .'</td>';
      $listaAfastados .= '<td>'. $disponivel .'</td>';
   $listaAfastados .= '</tr>';
}


$qry = '
select 
  concat(v.id, v.disponivel) id, concat(v.nome, " [ ", v.rt, " ] ",  if(v.disponivel=0, " [assinado]","")) nome , v.disponivel 
from 
   vinculov v
where 
   v.co_id  = "'. $coleg.'" 
   and v.ano = '. $anoQ .' ';

$lista = Outros::qry($qry);
$listaProfs = '';
foreach($lista as $li){
   $listaProfs .= '<option value="'. $li->id .'">'. $li->nome .'</option>';
}

include __DIR__.'/includes/content.php';

include '../includes/footer.php';
