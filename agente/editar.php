<?php
require '../vendor/autoload.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use \App\Session\Login;
use \App\Entity\Agente;
Login::requireLogin();
$user = Login::getUsuarioLogado();


define('TITLE','Editar dados do Agente');

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) ){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA AO PROJETO
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
/*  if ($obAgente->niveln> 0){
    $obAgente->ativo = 1;
  }
*/
  $obAgente->updated_at =  date('Y-m-d H:i:s');
  $obAgente->user = $_POST['user'];
  if(strlen($_POST['senha']) > 0 ){
     $obAgente->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
  }
  $obAgente->atualizar();

  header('location: index.php?status=success');
  exit;
}

echo '<pre>';
print_r($user);
echo '<hr>';
print_r($obAgente);
echo '</pre>';
exit;

include '../includes/header.php';
include __DIR__.'/includes/formulario.php';
include '../includes/footer.php';
  