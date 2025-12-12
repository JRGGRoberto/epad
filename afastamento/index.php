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
  v.id as id_vinc, p.id id24, v.nome,  p.modalidade, p.tipo, p.portaria, p.ch, p.dt_inicio, p.dt_fim, v.disponivel 
from 
   pad24 p 
   inner join vinculov v on v.id  = p.vinculo  and v.ano = '. $anoQ .'
where v.co_id  = "'. $coleg.'" ';

$lista = Outros::qry($qry);
$listaAfas = json_encode($lista);


$listaAfastados = '';


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
     case '22':
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
       $disponivel = '<button type="button" class="btn btn-light btn-sm" onclick="frmExcluirShow(\''.$af->id24.'\')">⛔</button>';
       
        break;
     case 0: 
       $disponivel = '🔒';
         break;
   }

   $listaAfastados .= '<tr>';
      $listaAfastados .= '<td>'. $af->nome .'</td>';
      $listaAfastados .= '<td> <a href="../padstoprn/index.php?id='. $af->id_vinc .'" target="_blank">📄</a></td>';
      $listaAfastados .= '<td>'. $modalidade .'</td>';
      $listaAfastados .= '<td>'. $tipo.'</td>';
      $listaAfastados .= '<td>'. $af->portaria .'</td>';
      $listaAfastados .= '<td>'. $af->ch .'</td>';
      $listaAfastados .= '<td>'. formaData($af->dt_inicio) .'</td>';
      $listaAfastados .= '<td>'. formaData($af->dt_fim) .'</td>';
      $listaAfastados .= '<td>'. $disponivel .'</td>';
   $listaAfastados .= '</tr>';
}

$qry = '
select * 
from vinculov v 
where 
  v.co_id = "'. $coleg.'"
  and ano = '. $anoQ .'
  and disponivel = 1
order by nome ';
$lista = Outros::qry($qry);
$listaProfs = json_encode($lista);


include __DIR__.'/includes/content.php';

include '../includes/footer.php';
