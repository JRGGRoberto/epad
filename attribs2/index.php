<?php

require '../vendor/autoload.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();
use App\Entity\Cargo;

if ($user['tipo'] != 'prof') {
    header('location: ../home/');
    exit;
}
$ok = false;

if ($user['tipo'] === 'prof') {
    // if($user['config'] == '1'){
    $ok = true;
    // }
}
$tipocod = $_GET['t'];
if (!$ok) {
    header('location: ../home/');
    exit;
}
$cargoid = substr($tipocod, 1, 36);
$tipocod = substr($tipocod, 0, 1);



// $ano = $user['year_sel'];

$cargoAttri = Cargo::get($cargoid);

/*
$co_id_tt = $cargoAttri['co_id_tt'];
$tipocod =  $cargoAttri['tipocod'];
$ano =      $cargoAttri['ano'];
*/

$co_id_tt = $cargoAttri->co_id_tt;
$tipocod = $cargoAttri->tipocod;
$ano = $cargoAttri->ano;

$texto = '';
switch ($tipocod) {
    case 'a':
        $texto = 'Orientação ao Estágio';
        break;
    case 'b':
        $texto = 'Orientação nas Atividades de aulas práticas em inst da área da saúde';
        break;
    case 'c':
        $texto = 'Orientação de Trabalhos acadêmicos Obrigatórios (TCCs, dissertações e teses)';
        break;
    case 'd':
        $texto = 'Orientação de Monitoria';
        break;
    case 'e':
        $texto = 'Orientação de estudante em PIC/PIBIC';
        break;
    case 'f':
        $texto = 'Orientação de estudante em PIBEX/PIBIS';
        break;
}

$funcSelected = '<option >'.$texto.'</option>';
include '../includes/header.php';

echo '<script> 
  const ano = "'.$ano.'";
  let co_id = "'.$co_id_tt.'";
  let tipo = "'.$tipocod.'";
</script>';

$tpOrientacao = '';
switch ($tipocod) {
    case 'a':
        $tpOrientacao = 'Orientação ao Estágio ';
        break;
    case 'b':
        $tpOrientacao = 'Orientação de Aulas Práticas em Saúde';
        break;
    case 'c':
        $tpOrientacao = 'Orientação à Trabalhos acadêmicos';
        break;
    case 'd':
        $tpOrientacao = 'Orientação de Monitoria';
        break;
    case 'e':
        $tpOrientacao = 'Orientação de estudante em PIC/PIBIC';
        break;
    case 'f':
        $tpOrientacao = 'Orientação de estudante em PIBEX/PIBIS';
        break;
}

include __DIR__.'/includes/content.php';

include '../includes/footer.php';
