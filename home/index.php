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
       v.ano, v.rt, v.id, a.edt
     from 
       usuarios u
       inner join vinculo v on u.id  = v.id_prof 
       inner join anos a on a.ano = v.ano
      where 
        u.id = "' . $user['id'] .'"
     order by v.ano desc;';
    $retorno = Outros::qry($sql);


    $opcoes = '';
    $qnt = 0;
    $yearss = 0;
    foreach( $retorno as $vinculo ){

        $btnClass = '';
        if($vinculo->edt == 0){
            $btnClass .= 'btn btn-info' ;
        } else {
            $btnClass .= 'btn btn-primary';
        }

        $opcoes .= '<a type="button" class="'.$btnClass.'"
                     href="../pad/index.php?ano='. $vinculo->ano.'"
                      style="text-align: center;">PAD '. $vinculo->ano 
                    .'</a><br><br>';
        $qnt++;
        $yearss = $vinculo->ano;
    }

    if($qnt == 0){
        $opcoes = '<p>Não há PAD vinculados a esta conta.</p>';
        $opcoes .= '<p>Qualquer problema entre em contato com o seu coordenador de curso.</p>';
    } 
    elseif (($qnt == 1) and ($yearss > 0)){
        header('location: ../pad/index.php?ano='.$yearss);
        exit;
    }


    include '../includes/header.php';
    
    include __DIR__.'/includes/content.php';
    include '../includes/footer.php';
   
} else {
     header('location: ../login/logout.php');
     exit; 
}


