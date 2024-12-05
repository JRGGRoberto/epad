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
       /* if($user['co_id']  !==   $_POST['co']){
            echo 'erro colegiado ';
            exit;
        }*/

        $vinc = $_POST['listaProf'];;
        $coA   = $_POST['coA'];
        $ano  = $_POST['ano'];
        $tipo = $_POST['listaFunc'];

        $where = ("(ano, id_vinculo, tipo ) = ('".$ano."', '".$vinc."', '".$tipo."')");
        $verif = Cargo::getQntd($where); 

        
        if($verif > 0 ){
            // send a error message
           header('location: ..');
           exit;
        } 

        $func = new Cargo();
        $func->id_vinculo    = $vinc;
        $func->id_colegiado  = $coA;
        $func->ano           = $ano;
        $func->tipo          = $tipo;
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
