<?php

require '../vendor/autoload.php';


use \App\Session\Login;
use \App\Entity\Arquivo;
use \App\Entity\Projeto;

//Obriga o usuário a estar logado
Login::requireLogin();

$tabela = $_GET['tab'];
$id_tab = $_GET['id'];

//VALIDAÇÃO DO NOME DO ARQUIVO
/*
if(!isset($_GET['arq']) or !is_numeric($_GET['arq'])){
  header('location: index.php?status=error');
  exit;
}
*/
//CONSULTA REGISTRO
$objArquivo = Arquivo::getArquivo($_GET['arq']);

//VALIDAÇÃO DA Campus
if($tabela != $objArquivo->tabela or $id_tab != $objArquivo->id_tab){
  header('location: /');
  exit;
}

if(!$objArquivo instanceof Arquivo){
  header('location: /');
  exit;
}

//VALIDAÇÃO DO POST
if(isset($_POST['excluir'])){

  $caminho = '../upload/uploads/';
  // Verificando se o arquivo realmente existe
  if (file_exists($caminho . $objArquivo->nome_rand) and !empty($objArquivo->nome_rand))
    unlink($caminho . $objArquivo->nome_rand);
  $objArquivo->excluir();
  $comp ='';
  if($objArquivo->tabela == 'projetos'){
    $ProjV = Projeto::getProjetoLast($id_tab)->ver;
    $comp = '&v='.$ProjV.'#attc';
  }

  header('location: ../'.$objArquivo->tabela.'/editar.php?id='.$id_tab.$comp);

  exit;
}

include '../includes/header.php';
include __DIR__.'/includes/confirmar-exclusao.php';
include '../includes/footer.php';