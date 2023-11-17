<?php

require '../vendor/autoload.php';

use \App\Entity\MatrizDisc;

$toDo = $_POST["to_do"];
$id_md = $_POST["id_md"];
$script = '';


//VALIDAÇÃO DO POST
if( isset($_POST['ano']) and isset($_POST['id_cur']) and isset($_POST["to_do"]) ){

  $obMatDis = new MatrizDisc();
  $ca          = $_POST["id_cam"];
  $ce          = $_POST["id_cen"];
  $co          = $_POST["id_cur"];
  $ano         = $_POST["ano"];
  $categ       = $_POST["categ"];
  $nome        = $_POST["nome"];   
  $ch          = $_POST["ch"];
  $habilitacao = $_POST["habilitacao"];
  $oferta      = $_POST["oferta"];
  $periodo     = $_POST["periodo"];
  $vagas       = $_POST["vagas"];
  $uid         = $_POST["uid"];

  if (!strcmp($toDo, 'add')) {
    $obMatDis->id_curso     = $co;
    $obMatDis->ano          = $ano;
    $obMatDis->categ        = $categ;
    $obMatDis->nome         = $nome;
    $obMatDis->ch           = $ch;
    $obMatDis->habilitacao  = $habilitacao;
    $obMatDis->oferta       = $oferta;
    $obMatDis->turno        = $periodo;
    $obMatDis->vagas        = $vagas;
    $obMatDis->user         = $uid;
    $id = $obMatDis->cadastrar();

    header('location: ../disciplinas/index.php?id='. $id);
    $script = 'function preenche("'. $ca  .'", "'. $ce  .'", "'. $co  .'", "'. $ano  .'") ';
    exit;

  } elseif (!strcmp($toDo, 'upd')) {
    $obMatDis = $obMatDis::getById($id_md);
    $obMatDis->id_curso     = $co;
    $obMatDis->ano          = $ano;
    $obMatDis->categ        = $categ;
    $obMatDis->nome         = $nome;
    $obMatDis->ch           = $ch;
    $obMatDis->habilitacao  = $habilitacao;
    $obMatDis->oferta       = $oferta;
    $obMatDis->turno        = $periodo;
    $obMatDis->vagas        = $vagas;
    $obMatDis->user         = $uid;
    $obMatDis->atualizar();

    header('location: ../disciplinas/index.php?id='. $obMatDis->id);
    $script = 'function preenche("'. $ca  .'", "'. $ce  .'", "'. $co  .'", "'. $ano  .'") ';
    exit;

  } elseif(!strcmp($toDo, 'conf')){
    $obMatDis = $obMatDis::getById($id_md);
    header('location: ../disciplinas/index.php?id='. $obMatDis->id);
    exit;

  } else {
    $script = '';
    header('location: index.php?status=error');
    exit;
  } 
} 


