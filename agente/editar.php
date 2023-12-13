<?php
require '../vendor/autoload.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use \App\Session\Login;
use \App\Entity\Agente;
Login::requireLogin();
$user = Login::getUsuarioLogado();

use \App\Entity\Campi;

$ca = Campi::getRegistros();
$opts = '';
foreach($ca as $c){
  $opts .= '<option value="'.$c->id .'">'. $c->nome.'</option>';
}


define('TITLE','Editar dados do Agente');

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) ){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA AO PROJETOecho '<pre>';
$obAgente = new Agente();
$obAgente = $obAgente::get($_GET['id']);


//VALIDAÇÃO DA TIPO
if(!$obAgente instanceof Agente){
  header('location: ../index.php?status=error');
  exit;
}

$msg = '?';

//VALIDAÇÃO DO POST
if(isset($_POST['nome'])){
  // $obAgente->id = $_POST['id'];
  $obAgente->nome = $_POST['nome'];
  $obAgente->cpf = $_POST['cpf'];
  $obAgente->email = $_POST['email'];
  $obAgente->cat_func = $_POST['cat_func'];
  $obAgente->ativo = $_POST['ativo'];
  $obAgente->lotacao = $_POST['lotacao'];
  $obAgente->config = $_POST['config'];
  $obAgente->updated_at =  date('Y-m-d H:i:s');
  $obAgente->user = $user['id'];
  if(strlen($_POST['senha']) > 0 ){
     $obAgente->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
  }
  $obAgente->atualizar();

  header('location: index.php?status=success');
  exit;
}

include '../includes/header.php';
include __DIR__.'/includes/formulario.php';
include '../includes/footer.php';
  