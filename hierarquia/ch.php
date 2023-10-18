<?php

require '../vendor/autoload.php';
use \App\Session\Login;
use \App\Entity\Diversos;

use \App\Entity\Campi;
use \App\Entity\Centro;
use \App\Entity\Colegiado;


Login::requireLogin();
$user = Login::getUsuarioLogado();

if( !(in_array($user[niveln], [1, 2, 3]) or $user[adm] == 1 )   ){
  header('location: ../index.php?status=error');
  exit;
} 

$cent_cood = $_GET['a']; // 2_centro 3_coord 1
$local = $_GET['b'];

define('SUBTITLE2', '<label><sup>Quem já possui algum cargo de <strong>coordenador</strong>, <strong>diretor de centro</strong> ou <strong>chefe de divisão</strong> não é listado</sup></label>');

if ($cent_cood == 1){

  $query = ' 
             select id, nome,
                if(niveln > 0, " SELECTED ", "") sel
             from  userprof
             where ativo  = 1 and niveln in (0, 1) and ca_id =  "'.$local .'"';
        
  $options = Diversos::qry($query);

  $nome = Campi::getRegistro($local);
  define('SUBTITLE', '<label>Selecione um novo <strong>Chefe de divisão:</strong> '.$nome->nome .'</label>');

  define('SUB22', $nome->nome );
    
} elseif ($cent_cood == 2){

  $query = ' 
             select id, nome, 
                if(niveln > 0, " SELECTED ", "") sel
             from  userprof
             where ativo  = 1 and niveln in (0, 2) and ce_id =  "'.$local .'"';
  
  $options = Diversos::qry($query);

  $nome = Centro::getRegistro($local);
  $campNome = Campi::getRegistro($nome->campus_id);

  define('SUBTITLE', '<label>Selecione um novo <strong>Diretor de Centro de Área:</strong> '.$nome->nome .'</label>');
  
  define('SUB22', $campNome->nome);

  
} elseif($cent_cood == 3){

  $query = ' 
             select id, nome,
                if(niveln > 0, " SELECTED ", "") sel
             from  userprof
             where ativo  = 1 and niveln in (0, 3) and co_id =  "'.$local .'"';
   
  $options = Diversos::qry($query);

  $nome = Colegiado::getRegistro($local);
  define('SUBTITLE', '<label>Selecione um novo <strong>Coordenador de colegiado:</strong> '.$nome->nome .'</label>');


  $campNome = Diversos::q('select campus, centros from ca_ce_co where co_id =  "'.$local .'" ');
  define('SUB22', $campNome->campus . ' \ ' . $campNome->centros );

} else {
  header('location: ../index.php?status=error');
  exit;
}

$OpcS = '';
$sel = false;
foreach($options as $opc){
  $OpcS .= '<option value="'.$opc->id.'"  '.$opc->sel.' >'.$opc->nome.'</option>';

  if(($opc->sel <> ' ') || $sel){
    $sel = true;
  }
}
/*
if($sel){
  $OpcoesS = $OpcS;
} else {
  $OpcoesS = '<option value="" SELECTED>Selecione um professor</option>';
  $OpcoesS .= $OpcS;
}
*/

$OpcoesS = '<option value="" SELECTED>Selecione um professor</option>';
$OpcoesS .= $OpcS;

define('TITLE','Atualização de posição');

//VALIDAÇÃO DO POST
if(isset( $_POST['selCoord']) ) {

  switch($cent_cood){
    case 1: 
            
            if( !(in_array($user[niveln], [1]) or $user[adm] == 1 )) {
              header('location: ./index.php?hi=cnf&status=error');
              exit;
            } 

            $upd = Campi::getRegistro($local);
            $upd->chef_div_id = $_POST['selCoord'];
            $upd->user = $user[id];
            $upd->atualizar();
      break;
    case 2: 

            if( !(in_array($user[niveln], [1, 2]) or $user[adm] == 1 )) {
              header('location: ./index.php?hi=cnf&status=error');
              exit;
            } 

            $upd = Centro::getRegistro($local);
            $upd->dir_ca_id =  $_POST['selCoord'];
            $upd->user = $user[id];
            $upd->atualizar();
      break;
    case 3: 

            if( !(in_array($user[niveln], [1, 2, 3]) or $user[adm] == 1 )) {
              header('location: ./index.php?hi=cnf&status=error');
              exit;
            } 

            $upd = Colegiado::getRegistro($local);
            $upd->coord_id =  $_POST['selCoord'];  
            $upd->user = $user[id];
            $upd->atualizar();
      break;
    default: header('location: ../index.php?status=error');
      break;
  }

  header('location: ./index.php?hi=cnf&status=success');
                                         
  exit;
}


include '../includes/header.php';
include __DIR__.'/includes/transf.php';
include '../includes/footer.php';