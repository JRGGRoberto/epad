<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();


use \App\Entity\Vinculo;
$v = new Vinculo;
$v = Vinculo::get('c9427a19-7eff-11ee-be98-0266ad9885af');

echo '<pre>';
print_r($user);
echo '<hr>';
print_r($v);
echo '</pre>';