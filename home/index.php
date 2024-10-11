<?php

require '../vendor/autoload.php';

use \App\Session\Login;
Login::requireLogin();
use \App\Entity\Outros;
$user = Login::getUsuarioLogado();

if($user['tipo'] == 'agente' &&  $user['adm'] == 1) {
    header('location: ../matrizes/');
    exit;
} if($user['tipo'] == 'agente') {
    header('location: ./branco.php');
    exit;

} elseif($user['tipo'] == 'prof') {
    $sql = 
    'select 
       v.ano, v.rt, v.id
     from 
       usuarios u
       inner join vinculo v on u.id  = v.id_prof 
      where 
        u.id = "' . $user['id'] .'"
     order by v.ano desc;';
    $retorno = Outros::qry($sql);


    $opcoes = '';
    foreach( $retorno as $vinculo ){

        if($vinculo->ano !=$user['AnoAtivo']){
            $opcoes .= '<a type="button" class="btn btn-info"  target="_blank"
                     href="../padstoprn/index.php?id='. $vinculo->id 
                    .'" style="text-align: center;">PAD '. $vinculo->ano 
                    .' ['. $vinculo->rt .']</a>';
        } else {
            $opcoes .= '<a type="button" class="btn btn-primary"
                     href="../pad/"
                      style="text-align: center;">PAD '. $vinculo->ano 
                    .' ['. $vinculo->rt .']</a>';
        }
        
    }

    include '../includes/header.php';
    
    include __DIR__.'/includes/content.php';
    include '../includes/footer.php';
   
} else {
     header('location: ../login/logout.php');
     exit; 
}


