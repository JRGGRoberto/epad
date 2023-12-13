<?php
require '../vendor/autoload.php';

use \App\Session\Login;
use \App\Entity\Professor;
use \App\Entity\Outros;
Login::requireLogin();
$user = Login::getUsuarioLogado();

use \App\Entity\Diversos;

define('TITLE','Editar dados do Professor');

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) ){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA AO PROJETO
$obProfessor = new Professor();
$obProfessor = $obProfessor::getProfessor($_GET['id']);

//VALIDAÇÃO DA TIPO
if(!$obProfessor instanceof Professor){
  header('location: ../index.php?status=error');
  exit;
}

$qryAEO = 
"select ca_id, campus, ce_id, centros, co_id, colegiado 
    from ca_ce_co ccc 
    where  co_id = '".  $obProfessor->id_colegiado ."'";

$Caeo = Diversos::q($qryAEO);

//VERIFICA PERMISSAO
$acessoOk = false;
$CAop = '';
$CEop = '';
$COop = '';
$script = '<script>';

$script .= 'var ca = document.querySelector("#ca");';
$script .= 'var ce = document.querySelector("#ce");';
$script .= 'var co = document.querySelector("#co");';

$msg = '?';

if (strcmp($user['id'],$_GET['id'])===0){
  $acessoOk = true;
  $msg = 'user[id] == $_GET[id]';
  $CAop = "<option value='".$Caeo->ca_id ."' readonly class='xpto3'>".$Caeo->campus .   "</option>";
  $CEop = "<option value='".$Caeo->ce_id ."' readonly class='xpto3'>".$Caeo->centros .  "</option>";
  $Coop = "<option value='".$Caeo->co_id ."' readonly class='xpto3'>".$Caeo->colegiado ."</option>";

} elseif ($user['adm'] != 1){
  switch($user['niveln']){
    case 1 :
      $CAop = "<option value='".$Caeo->ca_id ."' readonly class='xpto1'>". $Caeo->campus ."</option>";
      $script .= '
      pegarCE("'.$Caeo->ca_id .'").then(
        (onResolved) => {
          selectOpt("ce","'.$Caeo->ce_id .'")
        }, (onRejected) => { }
      ).then(
      (onResolved) => {
            pegarCO("'.$Caeo->ce_id .'").then(
              (onResolved) => {
                selectOpt("co","'.$Caeo->co_id .'")
              }, (onRejected) => { }
            )
        }, (onRejected) => { }
      )
      ';
      
      if ($user['ca_id'] == $obProfessor->ca_id ){
        $acessoOk = true;

        $msg = 'CA';
      }
      break;
    case 2 :
      $CAop = "<option value='".$Caeo->ca_id ."' readonly class='xpto2'>".$Caeo->campus ."</option>";
      $CEop = "<option value='".$Caeo->ce_id ."' readonly class='xpto2'>".$Caeo->centros ."</option>";

      $script .= '
      pegarCO("'.$Caeo->ce_id .'").then(
        (onResolved) => {
          selectOpt("co","'.$Caeo->co_id .'")
        }, (onRejected) => { }
      )
      ';
     
      if ($user['ce_id'] == $obProfessor->ce_id ){
        $acessoOk = true;

        $msg = 'CE';
      }
      break;
    case 3 :
      $CAop = "<option value='".$Caeo->ca_id ."' readonly class='xpto3'>".$Caeo->campus .   "</option>";
      $CEop = "<option value='".$Caeo->ce_id ."' readonly class='xpto3'>".$Caeo->centros .  "</option>";
      $Coop = "<option value='".$Caeo->co_id ."' readonly class='xpto3'>".$Caeo->colegiado ."</option>";
      if ($user['co_id'] == $obProfessor->co_id ){
        $acessoOk = true;

        $msg = 'CO';
      }
      break;
    }
} elseif ($user['adm'] == 1) {
  $acessoOk = true;

  $msg = 'ADM';

  $script .= '
  pegarCA().then( 
      (onResolved) => {
          selectOpt("ca","'.$Caeo->ca_id .'")
      }, (onRejected) => { }
  ).then(
    (onResolved) => {
          pegarCE("'.$Caeo->ca_id .'").then(
            (onResolved) => {
              selectOpt("ce","'.$Caeo->ce_id .'")
            }, (onRejected) => { }
          )
      }, (onRejected) => { }
  ).then(
    (onResolved) => {
          pegarCO("'.$Caeo->ce_id .'").then(
            (onResolved) => {
              selectOpt("co","'.$Caeo->co_id .'")
            }, (onRejected) => { }
          )
      }, (onRejected) => { }
  )
  ';
} else {
  $acessoOk = false;
  $msg = 'nada';
}


$script .= '</script>';

if (!$acessoOk){
  header('location: ../home/index.php?status=error');
  exit;
}

//VALIDAÇÃO DO POST
if(isset($_POST['nome'])){

 // $obProfessor->id = $_POST['id'];
  $obProfessor->nome = $_POST['nome'];
  $obProfessor->cpf = $_POST['cpf'];
  $obProfessor->telefone = $_POST['telefone'];
  $obProfessor->lattes = $_POST['lattes'];
  $obProfessor->titulacao = $_POST['titulacao'];
  $obProfessor->email = $_POST['email'];
  $obProfessor->id_colegiado = $_POST['id_colegiado'];
  $obProfessor->cat_func = $_POST['cat_func'];
  $obProfessor->ativo = $_POST['ativo'];
  if ($obProfessor->niveln> 0){
    $obProfessor->ativo = 1;
  }
  $obProfessor->adm = $_POST['adm'];
  $obProfessor->updated_at =  date('Y-m-d H:i:s');
  $obProfessor->user = $_POST['user'];
  if(strlen($_POST['senha']) > 0 ){
     $obProfessor->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
  }
  $obProfessor->atualizar();

  header('location: index.php?status=success');
  exit;
}

include '../includes/header.php';
include __DIR__.'/includes/formulario.php';
include '../includes/footer.php';
  