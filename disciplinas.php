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


echo '<pre>';
print_r($disc);
echo '<hr>';
print_r($inf);
echo '</pre>';

