<?php

require '../vendor/autoload.php';
use \App\Session\Login;
use \App\Entity\Campi;
use \App\Entity\Centro;
use \App\Entity\Colegiado;
use \App\Entity\Professor;
use \App\Entity\Diversos;

//Obriga o usuário a estar logado
Login::requireLogin();
$user = Login::getUsuarioLogado();

require('../includes/msgAlert.php');


$opc = $_GET['hi'];


/////////////////////////////////////

function showAll($adm=0, $nivel=0, $caU, $ceU, $coU){

  $qry2 = 
   'select id from campi';

  $contudo = '';

  $listCampus = Diversos::qry($qry2);
  foreach($listCampus as $ca){ 
    $contudo .= addInfoCa($ca->id, $adm, $nivel, $caU, $ceU, $coU, 'show');
  }
  
  return '
  
  <div id="accordion_allCa">

    <div class="card mb-1">
      <div class="card-header">
        <div class="row">
          <div class="col-1">
            <img src="../imgs/logo_unespar.png" alt="" loading="lazy" class="d-inline-block align-top ml-3" width="44" height="48">
          </div>
          <div class="col">
            <div>
               <h5 >UNESPAR - Universidade Estadual do Paraná </h5>
            </div>
            <div>
               Lista de campus pertecentes a  UNESPAR
            </div>
          </div>
          
          
        </div>

        </a>
      </div>
      <div id="callc" class="collapse show" data-parent="#accordion_allCa">
        <div class="card-body">
        <!-- conteudo -->
        '.$contudo.'
        <!-- conteudo -->
        </div>
      </div>
    </div>
  
    </div>
  ';



}
/////////////////////////////////////
function addInfoCa($idca, $adm, $nivel, $caU, $ceU, $coU, $show = ''){

  $ca = Campi::getRegistro($idca);

  if ($ca->chef_div_id != null){
    $prof = Professor::getProfessor($ca->chef_div_id);
    $nome = '<strong>'. $prof->nome .'</strong>';
  } else {
    $nome = ' <span class="badge badge-danger">a definir</span>';
  }

  $qry2 = 
   'select id from centros c where c.campus_id = "'.$ca->id .'"';

  $contudo = '';

  $listCentros = Diversos::qry($qry2);
  foreach($listCentros as $cent){ 
    $contudo .= addInfoCe($cent->id, $adm, $nivel, $caU, $ceU, $coU);

  }

  $alteraCA = '';
  if ($adm == '1' ){
    $alteraCA = '<span class="badge badge-light"><a href="./ch.php?a=1&b='.$ca->id.'">Alterar</a></span>';
  }
  
  
  return '
  
  <div id="accordion_ca">

    <div class="card mb-1">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-6">
          <a class="collapsed card-link" data-toggle="collapse" href="#ce'. $ca->id .'"><span class="badge badge badge-primary">
          &nbsp; &nbsp; </span> &nbsp; Campus <strong>'. $ca->nome .'</strong></a></div>
          <div class="col-sm-6">Chefe de Divisão: &nbsp; '. $nome .'<br>'.$alteraCA .'</div>
       </div>

        </a>
      </div>
      <div id="ce'. $ca->id .'" class="collapse '.$show.'" data-parent="#accordion_ca">
        <div class="card-body">
        <!-- conteudo -->
        '.$contudo.'
        <!-- conteudo -->
        </div>
      </div>
    </div>
  
    </div>
  ';

}

/////////////////////////////////////

function addInfoCe($idcen, $adm, $nivel, $caU, $ceU, $coU, $show = ''){

  $ce = Centro::getRegistro($idcen);

  if ($ce->dir_ca_id != null){
    $prof = Professor::getProfessor($ce->dir_ca_id);
    $nome = '<strong>'.$prof->nome .'</strong>';
  } else {
    $nome = ' <span class="badge badge-danger">a definir</span>';
  }

  $qry2 = 
   'select id from colegiados c where c.centro_id = "'.$ce->id .'"';

  $contudo = '';

  $listColeg = Diversos::qry($qry2);
  foreach($listColeg as $col){ 
    $contudo .= addInfoCo($col->id, $adm, $nivel, $caU, $ceU, $coU);
  }

  $user_adm = $adm;
  $texto = 
  '
  <div id="accordion_ce">
  
    <div class="card mb-1">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-6">
          <a class="collapsed card-link" data-toggle="collapse" href="#ce'. $ce->id .'"><span class="badge badge badge-secondary">
          &nbsp; &nbsp; </span> &nbsp; <strong>'. $ce->nome .'</strong></a></div>
          <div class="col-sm-6">'. $user_adm .' Diretor(ª) de Centro de Área: &nbsp; '. $nome ;
  
  if (  ($adm == 1 ) or ((in_array($nivel, [1]))   and ( $caU == $ce->campus_id )) ){
    $texto .=  '<br><span class="badge badge-light"><a href="./ch.php?a=2&b='.$ce->id.'">Alterar</a></span>';
  } 
          
   $texto .=   '</div>
       </div>
        </a>
      </div>
      <div id="ce'. $ce->id .'" class="collapse '.$show.'" data-parent="#accordion_ce">
        <div class="card-body">
        <!-- conteudo -->
        '.$contudo.'
        <!-- conteudo -->
        </div>
      </div>
    </div>
  
  </div>
  ';

  return $texto;

}

/////////////////////////////////////

function addInfoCo($idcol, $adm, $nivel, $caU, $ceU, $coU, $show = ''){

  $co = Colegiado::getRegistro($idcol);

  if ($co->coord_id != null){
    $prof = Professor::getProfessor($co->coord_id);
    $nome = '<strong>'.$prof->nome .'</strong>';
  } else {
    $nome = ' <span class="badge badge-danger">a definir</span>';
  }

  $qry2 = 
  'SELECT nome, email, titulacao, lattes
   from professores p where p.id_colegiado  = "'.$idcol .'"';

  $contudo = '';

  $listaProf = Diversos::qry($qry2);
  foreach($listaProf as $pf){ 
    
    $contudo .= ' <div class="row">
                    <div class="col-sm-4 mb-1">
                      <div>
                        <strong>'. $pf->nome .'</strong>
                      </div>
                      <div>
                        '. $pf->titulacao .'
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <a href="mailto:'.$pf->email.'">'.$pf->email.'</a>
                    </div>
                    <div class="col-sm-4">
                       <a href="http://lattes.cnpq.br/'.$pf->lattes.'" target="_blank">http://lattes.cnpq.br/'.$pf->lattes.'</a>
                    </div>
                  </div> <hr>';
  }

  $alteraCO = '';
  $printAlt = '<span class="badge badge-light"><a href="./ch.php?a=3&b='.$co->id.'">Alterar</a></span>';


  if ($adm == 1 ){
    $alteraCO = $printAlt;
  } elseif (($ceU == $co->centro_id ) and in_array($nivel, [2])){
    $alteraCO = $printAlt;
  } elseif ( in_array($nivel, [1]) ){
    $ce1 = Centro::getRegistro($co->centro_id);
    if($caU == $ce1->campus_id){
      $alteraCO = $printAlt;
    }
  }
 

  return '
    <div id="accordion_co">


    <div class="card mb-1">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-6">
          <a class="collapsed card-link" data-toggle="collapse" href="#co'. $co->id .'"><span class="badge badge badge-success">
          &nbsp; &nbsp; </span> &nbsp; Colegiado de <strong>'. $co->nome .'</strong></a></div>
          <div class="col-sm-6">Coordenador(ª): &nbsp; '. $nome .'<br>'.$alteraCO .'</div>
       </div>

        </a>
      </div>
      <div id="co'. $co->id .'" class="collapse '.$show.'" data-parent="#accordion_co">
        <div class="card-body">
        <!-- conteudo -->

        '.$contudo.'
        <!-- conteudo -->
        </div>
      </div>
    </div>
  
    </div>  
  ';

}


$msg = '';

switch ($opc) {
    case 'ca':
      $msg =  addInfoCa($user['ca_id'], $user['adm'], $user['niveln'], $user['ca_id'], $user['ce_id'], $user['co_id'], "show");

      break;

    case 'ce': 
      $msg = addInfoCe($user['ce_id'], $user['adm'], $user['niveln'], $user['ca_id'], $user['ce_id'], $user['co_id'], "show");
            
      break;

    case 'co':
      $msg = addInfoCo($user['co_id'], $user['adm'], $user['niveln'], $user['ca_id'], $user['ce_id'], $user['co_id'], "show");
      
      
      break;

    case 'cnf':
      if( !(in_array($user['niveln'], [1, 2, 3]) or $user['adm'] == 1 )   ){
        header('location: ../index.php?status=error');
        exit;
      } 
      $msg = showAll($user['adm'], $user['niveln'], $user['ca_id'], $user['ce_id'], $user['co_id'] );
      break;
    
    default:
        header('location: ../');
        exit;
      break;
 }



include '../includes/header.php';

echo '<h2 class="mt-0">Hierarquia</h2>';

echo $msgAlert;

echo $msg;

include '../includes/footer.php'; 