<?php

require '../../vendor/autoload.php';
use \App\Entity\PADAtiv23;
use \App\Session\Login;

Login::requireLogin();
$user = Login::getUsuarioLogado();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['vinculo'])){

        if($user['config']  !==  '1'){
            echo 'erro config';
            exit;
        }
        if($user['tipo']  !==  'prof'){
            echo 'erro tipo';
            exit;
        }
      
        $pad23 = new PADAtiv23();
        $pad23->vinculo         = $_POST['vinculo'];
        $pad23->id_co           = $user ['co_id'];;
        $pad23->atividade       = $_POST['atividade'];
        $pad23->nome_atividade  = $_POST['nome_atividade'];
        $pad23->ch              = $_POST['ch'];
        $pad23->ano             = $_POST['ano'];

        $pad23->user            = $user['id'];
        $pad23->add();

        header('location: ..');   
    } 
 }
?>
