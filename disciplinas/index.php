<?php

require './vendor/autoload.php';

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
include __DIR__.'/includes/listagem.php';
include '../includes/footer.php'; 
