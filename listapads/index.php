<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

$galeraDoSuporte = array(
  'b8fa555f-cedb-47cf-91cc-7581736aac88', // Roberto
  '8154fff1-becd-11ee-801b-0266ad9885af',   // Sérgio
  '81512d7d-becd-11ee-801b-0266ad9885af' );   // Dorigão

if(!in_array($user['id'], $galeraDoSuporte)){ 
  header('location: ../home/');
  exit;
}


use \App\Entity\Vinculo;

$where = ' 1 = 1 ';
$order = ' campus, codcentro, colegiado, nome ';
$vinc = Vinculo::gets($where, $order);
$tab = '';
foreach($vinc as $v){
  $tab .= '<tr>';
    $tab .= '<td>'. $v->campus .'</td> <td>'. $v->codcentro .'</td><td>'. $v->colegiado .'</td>';
    $tab .= '<td>'. $v->nome .
                '<a href="../padstoprn/index.php?id='.  $v->id .'" target="_blank">🅿️</a>
                 
            </td>' ;
    $tab .= '<td style="text-align: right;">'. $v->rt .'</td>';
  $tab .= '</tr>';
}


if($user['tipo'] == 'agente') {
  header('location: ../matrizes/');
  exit;
} elseif($user['tipo'] == 'prof') {
  // header('location: ../pad/');
  include '../includes/header.php';
  include __DIR__.'/includes/content.php';

  include '../includes/footer.php';
   
   
} else {
   header('location: ../login/logout.php');
   exit; 
}


