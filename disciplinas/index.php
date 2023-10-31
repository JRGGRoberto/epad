<?php

require '../vendor/autoload.php';

use \App\Session\Login;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Obriga o usuário a estar logado
Login::requireLogin();
// $user = Login::getUsuarioLogado();

use \App\Entity\MatrizDisc;
use \App\Entity\Outros;

$disc = new MatrizDisc();
$disc = $disc::getById($_GET['id']);

$inf = Outros::hierCol($disc->id_curso);

include '../includes/header.php';


$oferta = '';
switch ($disc->oferta) {
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
switch ($disc->habilitacao) {
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
switch ($disc->turno) {
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



include __DIR__.'/includes/listagem.php';
include '../includes/footer.php'; 

