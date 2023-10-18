<?php

require '../vendor/autoload.php';

use \App\Session\Login;

//Obriga o usuário a estar logado
Login::requireLogin();
$user = Login::getUsuarioLogado();

use \App\Entity\Professor;
use \App\Db\Pagination;

//Busca
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);
$campus = filter_input(INPUT_GET, 'campus', FILTER_SANITIZE_STRING);
$colegiado = filter_input(INPUT_GET, 'colegiado', FILTER_SANITIZE_STRING);
$centro = filter_input(INPUT_GET, 'centro', FILTER_SANITIZE_STRING);


//Filtro de status
$filtroStatus = filter_input(INPUT_GET, 'filtroStatus', FILTER_SANITIZE_STRING);

//Condições SQL
$condicoes = [
  strlen($busca) ? 'nome LIKE "%'.str_replace(' ','%',$busca).'%"': null,
  strlen($campus) ? "campus = '$campus'": null,
  strlen($colegiado) ? 'colegiado LIKE "%'.str_replace(' ','%',$colegiado).'%"': null,
  strlen($centro) ? 'centros LIKE "%'.str_replace(' ','%',$centro).'%"': null
];


//Remove posições vazias
$condicoes = array_filter($condicoes);

// Cláusula WHERE
$where = implode(' AND ', $condicoes);

//Qntd total de registros
$qntProfessores = Professor::getQntdProfessores($where);

//paginação
$obPagination = new Pagination($qntProfessores, $_GET['pagina']?? 1, 10);

$professores = Professor::getProfessores($where, 'nome', $obPagination->getLimite());



$CAop = '';
$CEop = '';
$COop = '';
$script = '<script>';

if ($user['adm'] != 1){
  switch($user['niveln']){
    case 1 :
      $CAop = "<option value='".$user['ca_id'] ."' readonly class='xpto1'>".$user['campus'] ."</option>";
      $script .= 'var ce = document.querySelector("#ce");';
      $script .= 'var co = document.querySelector("#co");';
      $script .= 'pegarCE("'.$user['ca_id'] .'");';
      break;
    case 2 :
      $CAop = "<option value='".$user['ca_id'] ."' readonly class='xpto2'>".$user['campus'] ."</option>";
      $CEop = "<option value='".$user['ce_id'] ."' readonly class='xpto2'>".$user['centros'] ."</option>";
      $script .= 'var co = document.querySelector("#co");';
      $script .= 'pegarCO("'.$user['ce_id'] .'");';
      break;
    case 3 :
      $CAop = "<option value='".$user['ca_id'] ."' readonly class='xpto3'>".$user['campus'] .   "</option>";
      $CEop = "<option value='".$user['ce_id'] ."' readonly class='xpto3'>".$user['centros'] .  "</option>";
      $Coop = "<option value='".$user['co_id'] ."' readonly class='xpto3'>".$user['colegiado'] ."</option>";
      break;
    }
} elseif ($user['adm'] == 1){
  $script .= 'var ca = document.querySelector("#ca");';
  $script .= 'var ce = document.querySelector("#ce");';
  $script .= 'var co = document.querySelector("#co");';
  $script .= 'pegarCA();';
}
$script .= '</script>';


include '../includes/header.php';
include __DIR__.'/includes/listagem.php';
include '../includes/footer.php'; 
