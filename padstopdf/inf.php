<?php
require '../vendor/autoload.php';
use \App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();

echo '<pre>';
print_r($user);
echo '</pre>';