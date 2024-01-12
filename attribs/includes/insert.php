<?php

require '../../vendor/autoload.php';
use \App\Entity\Cargo;
use \App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['listaFunc'])){

        if($user['config']  !==  '1'){
            echo 'erro config';
            exit;
        }
        if($user['tipo']  !==  'prof'){
            echo 'erro tipo';
            exit;
        }
        if($user['co_id']  !==   $_POST['co']){
            echo 'erro colegiado ';
            exit;
        }

        $func = new Cargo();
        $func->id_vinculo    = $_POST['listaProf'];;
        $func->id_colegiado  = $_POST['co'];
        $func->ano           = $_POST['ano'];
        $func->tipo           = $_POST['listaFunc'];
        $func->user  = $user['id'];
        if($func->cadastrar()){
            header('location: ..');
            exit; 
        } else {
           echo $_POST['listaFunc'];
           echo '<br>';
           echo $_POST['listaProf'];
           echo '<br>';
           echo $_POST['ano'];
           echo '<br>';
           echo $_POST['co'];
           echo '<pre>';
           print_r($user);
           echo '</pre>';
        }
    } 
 }
?>
