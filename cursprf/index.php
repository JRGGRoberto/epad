<?php

require '../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use \App\Entity\MatrizDisc;
use \App\Entity\Outros;
use \App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();

if($user['tipo'] != 'prof'){
  header('location: ../home/');
  exit;
}

$matriz = new MatrizDisc();
$matriz = $matriz::getById($_GET['id']);


$inf = Outros::hierCol($matriz->id_curso);


$oferta = '';
switch ($matriz->oferta) {
    case 'a':
        $oferta ='Seriado anual com disciplinas anuais';
        break;
    case 's':
        $oferta ='Seriado anual com disciplinas semestrais';
        break;
    case 'm':
        $oferta ='Seriado anual com disciplinas anuais e semestrais (misto)';
        break;
    default:
        $oferta = 'Não definido';
}

$habil = '';
switch ($matriz->habilitacao) {
    case 'l':
        $habil ='Licenciatura';
        break;
    case 'b':
        $habil ='Bacharelado';
        break;
    default:
        $habil = 'Não definido';
}

$turno= '';
switch ($matriz->turno) {
    case 'm':
      $turno = 'Matutino';
      break;
    case 'v':
      $turno = 'Vespertino';
      break;
    case 'n':
      $turno = 'Noturno';
      break;
    case 'i':
      $turno = 'Integral';
      break;
    default:
      $turno = 'Não definido';
}

$script = 
" <script> 
    getDBMD('". $matriz->id ."');
 </script>";


include '../includes/header.php';
include __DIR__.'/includes/listagem.php';
include '../includes/footer.php';
