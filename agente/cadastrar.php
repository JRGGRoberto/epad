<?php

require '../vendor/autoload.php';
use \App\Session\Login;
use \App\Entity\Agente;

//Obriga o usuário a estar logado
Login::requireLogin();
$user = Login::getUsuarioLogado();

define('TITLE','Cadastrar Agente');

use \App\Entity\Campi;

$ca = Campi::getRegistros();
$opts = '';
foreach($ca as $c){
  $opts .= '<option value="'.$c->id .'">'. $c->nome.'</option>';
}


$obAgente = new Agente;
$obAgente->ativo = 1;

//VALIDAÇÃO DO POST
if(isset($_POST['nome'])){

  // $obAgente->id = $_POST['id'];
   $obAgente->nome = $_POST['nome'];
   $obAgente->cpf = $_POST['cpf'];
   $obAgente->email = $_POST['email'];
   $obAgente->lotacao = $_POST['lotacao'];
   $obAgente->cat_func = $_POST['cat_func'];
   $obAgente->ativo = $_POST['ativo'];
   $obAgente->user = $user['id'];
   if(strlen($_POST['senha']) > 0 ){
      $obAgente->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
   }

   $obAgente->cadastrar();

   header('location: index.php?status=success');
   exit;
 }

include '../includes/header.php';
include __DIR__.'/includes/formulario.php';
include '../includes/footer.php';
