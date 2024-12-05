<?php
require '../vendor/autoload.php';

use \App\Session\Login;
use \App\Entity\Professor;
use \App\Entity\Vinculo;
Login::requireLogin();
$user = Login::getUsuarioLogado();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//CONSULTA AO PROJETO
$obProfessor = new Professor();
$obProfessor = $obProfessor::getProfessor( $user['id']);
//VALIDAÇÃO DA TIPO
if(!$obProfessor instanceof Professor){
  header('location: ../index.php?status=error');
  exit;
}
if($obProfessor->id <> $user['id']){
  header('location: ../index.php?status=error');
  exit;
}

//$vinculo = Vinculo::getByAnoProf($obProfessor->id, $anoLetivo);
$retorno = Vinculo::gets('id_prof = "'.$obProfessor->id.'"');


$opcoes = '';
$qnt = 0;
$yearss = 0;

foreach( $retorno as $vinculo ){

    if($vinculo->anosedt == 0){
        $opcoes .= ' <a type="button" class="btn btn-info"          href="./ano.php?a='. $vinculo->ano.'"
                  style="text-align: center;">PAD '. $vinculo->ano  .' ['. $vinculo->rt .']</a> <br><br>' ;
    } else {
        $opcoes .= ' <a type="button" class="btn btn-primary"       href="./ano.php?a='. $vinculo->ano.'"
                  style="text-align: center;">PAD '. $vinculo->ano  .' ['. $vinculo->rt .']</a> <br><br>';
    }
    $qnt++;
    $yearss = $vinculo->ano;
}
if($qnt == 0){
  $opcoes = '<p>Não há PAD vinculados a esta conta.</p>';
  $opcoes .= '<p>Qualquer problema entre em contato com o seu coordenador de curso.</p>';
} 
elseif (($qnt == 1) and ($yearss > 0)){
  header('location: ./ano.php?a='.$yearss);
  exit;
}


include '../includes/header.php';
echo '<main>
  <h2 class="mt-3">Informações do meu PAD [cabeçalho 1.]</h2><hr>';
echo $opcoes;
echo '</main>';

include '../includes/footer.php';
  