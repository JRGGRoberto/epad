<?php
require '../vendor/autoload.php';

use \App\Session\Login;
use \App\Entity\Professor;
use \App\Entity\Vinculo;
Login::requireLogin();
$user = Login::getUsuarioLogado();



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
if($obProfessor->id <> $user['id']){
  header('location: ../index.php?status=error');
  exit;
}


$anoLetivo = $user['AnoAtivo'];
$vinculo = new Vinculo();
$vinculo = Vinculo::getByAnoProf($obProfessor->id, $anoLetivo);
define('TITLE','Editar dados do vinculo de '. $anoLetivo);

$dados = false;

if (!is_null($vinculo)){
  if ($vinculo->ano == $anoLetivo){
    $dados = true;
  }
}

if(isset($_POST['nome'])){
 
  $vinculo->dt_obtn_tit     = $_POST['dt_obtn_tit'];
  $vinculo->tempo_cc        = $_POST['tempo_cc'];
  $vinculo->tempo_esu       = $_POST['tempo_esu'];
  $vinculo->area_concurso   = $_POST['area_concurso'];
  $vinculo->user            = $user['id'];
 
  $vinculo->atualizar();

  header('location: ./../index.php?status=success');
  
  exit;
}

include '../includes/header.php';
if ($dados){
   include __DIR__.'/includes/formulario.php';
} else {
  echo '<pre>';
print_r($vinculo);
echo '</pre>';
  echo 
  '<main>
     <h2 class="mt-3">Vinculo não encontrado</h2>
     <p>Seu vinculo '.$anoLetivo . ' ainda não foi registrado.  </p>
     <p></p>
  </main>';
}
include '../includes/footer.php';
  