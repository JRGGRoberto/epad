<?php

require '../../vendor/autoload.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use \App\Session\Login;
use \App\Entity\PADAtiv24;

Login::requireLogin();
$user = Login::getUsuarioLogado();
$pd24 = new PADAtiv24();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if($user['config']  !==  '1'){
        echo 'erro config';
        exit;
    }
    if($user['tipo']  !==  'prof'){
        echo 'erro tipo';
        exit;
    }
    
    $pd24->vinculo    = $_POST['vinculo'];
    $pd24->ano        = $_POST['ano'];   // aaaa
    $pd24->modalidade = $_POST['modalidade'];
    $pd24->ch         = $_POST['chAfasta'];
    $pd24->tipo       = $_POST['tipo'];
    $pd24->portaria   = $_POST['portaria'];
    $pd24->dt_inicio  = $_POST['dt_inicio'];
    $pd24->dt_fim     = $_POST['dt_fim'];
    $pd24->user       = $user['id'];

    if($pd24->cadastrar()){
        header('location: ..');
        exit; 
    } else {
/** */
    }
}

?>
