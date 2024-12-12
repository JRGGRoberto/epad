<?php

require '../../vendor/autoload.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use \App\Session\Login;
use \App\Entity\PADAtiv24;

Login::requireLogin();
$user = Login::getUsuarioLogado();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if($user['config']  !==  '1'){
        header('location: ..');
        exit;
    }
    if($user['tipo']  !==  'prof'){
        header('location: ..');
        exit;
    }
    
    $pd24 = PADAtiv24::getById($_POST['idAtivDel']);

    if (!$pd24 instanceof PADAtiv24) {
        header('location: ..');
        exit;
    }

    if($pd24->excluir()){
        header('location: ..');
        exit; 
    } else {
/** */
    }

}

?>
