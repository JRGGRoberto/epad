<?php

require '../vendor/autoload.php';

use App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();

if ($user['adm'] != 1) {
    header('location: ../home/branco.php');
    exit;
}

include '../includes/header.php';
$uid = $user['id'];
include __DIR__.'/includes/content.php';
include '../includes/footer.php';
