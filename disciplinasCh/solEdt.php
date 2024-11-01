<?php

require '../vendor/autoload.php';

use \App\Entity\MatrizDisc;
use \App\Entity\Outros;
use \App\Session\Login;
use \App\Entity\Colegiado;

Login::requireLogin();
$user = Login::getUsuarioLogado();
$id_user = $user['id'];

$coordenador = Colegiado::getQntdRegistros('coord_id  =  "'.  $id_user .'"');
// $coordenador == 0 Não é
// > 0 sim onde N = número de coodenações

include '../includes/header.php';
// include __DIR__.'/includes/listagem.php';
echo '<pre>';
print_r($user);
echo '</pre>';
echo $coordenador;

include '../includes/footer.php';