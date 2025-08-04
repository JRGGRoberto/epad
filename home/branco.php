<?php

require '../vendor/autoload.php';

use App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();

include '../includes/header.php';
$uid = $user['id'];
echo '<div class="container p-3 my-3 bg-white text-dark" style="padding : 25px">';
echo 'Bem vindo';
echo '<pre>';

echo '</pre>';
echo '</div>';
include '../includes/footer.php';
