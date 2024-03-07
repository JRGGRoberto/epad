<?php

require '../vendor/autoload.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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


use \App\Entity\FaleConosco;
if(!isset($_GET['t']) ){
    header('location: index.php?status=error');
    exit;
}


$msg = FaleConosco::getById($_GET['t']);

include '../includes/header.php';
include __DIR__.'/includes/content.php';


include __DIR__.'/includes/contentend.php';
include '../includes/footer.php';