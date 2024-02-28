<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

use \App\Entity\Vinculo;
$order = ' campus, codcentro, colegiado, nome ';
$vinc = Vinculo::gets();
$tab = '';
foreach($vinc as $v){
  $tab .= '<tr>';
    $tab .= '<td>'. $v->campus .'</td> <td>'. $v->codcentro .'</td><td>'. $v->colegiado .'</td>';
    $tab .= '<td>'. $v->nome .' <a href="../padstoprn/index.php?id='. $v->id .'" target="_blank">🅿️</a></td>' ;
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


