<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

include '../includes/header.php';

echo '<pre>';
print_r($user);
echo '</pre>';

$uid = $user['id'];

echo $uid;
include __DIR__.'/includes/content.php';
include '../includes/footer.php'; 