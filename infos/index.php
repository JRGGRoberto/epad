<?php

require '../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();


$tbl_contrads = '<h5>Quadro de professores atual do meu colegiado</h5>';
include __DIR__.'/includes/quad_prof.php';

$tbl_rt = "<h5>Distribuição de RT no colegiado de ".  $user['co_nome']  ."</h5>";
include __DIR__.'/includes/rt.php';

$tbl_matriz = "<h5>Matriz(es) do curso ".  $user['co_nome']  ." - ".  $user['lota_nome']  ."/".  $user['ce_cod']  . "</h5>";
include __DIR__.'/includes/matriz.php';

$tbl_disc = "<h5>Matriz(es)/Disciplinas do curso" .  $user['co_nome'] ." - ".  $user['lota_nome'] ."/".  $user['ce_cod']  ."</h5>";
include __DIR__.'/includes/disp.php';

$tbl_disc1 = "<h5>Professores distribuidos por disciplinas" .  $user['co_nome']  ." - ".  $user['lota_nome']  ."/".  $user['ce_cod']  ."</h5>";
include __DIR__.'/includes/disp1.php';

$tbl_prof = "<h5>Quadro de professores do colegiado" .  $user['co_nome']  ." - ".  $user['lota_nome']  ."/".  $user['ce_cod']  ."</h5>";
include __DIR__.'/includes/profs.php';

$tbl_pad22 = "<h5>Atividades de Supervisão e Orientação dos Professores do colegiado" . $user['co_nome']  ." - ".  $user['lota_nome']  ."/".  $user['ce_cod']  ."</h5>";
include __DIR__.'/includes/pad22.php';

include '../includes/header.php';
include __DIR__.'/includes/content.php';
include '../includes/footer.php';
   
   