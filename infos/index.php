<?php

require '../vendor/autoload.php';
use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

include '../includes/header.php';
include __DIR__.'/includes/content.php';
include '../includes/footer.php';
   
   