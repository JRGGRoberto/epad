<?php

require '../vendor/autoload.php';
use \App\Entity\Outros;
use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();

if($user['config'] != 1){
  header('location: ../');
  exit;
}


/*
$co_id = substr($_GET["id"],0,36);
$ano = substr($_GET["id"],36,4);
*/

$ano = $_SESSION['proecunespar']['year_sel'];
$co_id =  $_SESSION['proecunespar']['id_coSel'];


$sql = 
"select 
   campus, codcentro, co_id , colegiado, ano
from 
  ca_ce_co ccc,
  anos a 
WHERE  
  co_id = '".$co_id  ."'
  and a.ano = '".$ano  ."'
order by campus, colegiado ";


$q = Outros::q($sql);

$col_nome    = $q->colegiado;
$camp_nome   = $q->campus;
$centro_nome = $q->codcentro;



define('VOLTAR', '<a href="#voltar">Voltar</a>');

class Relatorios{
    public $id;
    public $titulo;
    public $conteudo;

    public function __construct($id, $titulo, $conteudo)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->conteudo = $conteudo;
        
    }
}

$tbl_contrads = '';
include __DIR__.'/includes/quad_prof.php';
$item = new Relatorios("id1", "Quadro de professores atual do meu colegiado", $tbl_contrads);
$itens [] = $item;

$tbl_rt = '';
include __DIR__.'/includes/rt.php';
$item = new Relatorios("id2", "Distribuição de RT no colegiado de", $tbl_rt);
$itens [] = $item;

$tbl_matriz = '';
include __DIR__.'/includes/matriz.php';
$item = new Relatorios("id3", "Matriz(es) do curso", $tbl_matriz);
$itens [] = $item;

$tbl_disc = '';
include __DIR__.'/includes/disp.php';
$item = new Relatorios("id4", "Matriz(es)/Disciplinas do curso", $tbl_disc);
$itens [] = $item;

$tbl_cres = '';
include __DIR__.'/includes/cres.php';
$item = new Relatorios("id55", "CRES", $tbl_cres);
$itens [] = $item;

$tbl_efet = '';
include __DIR__.'/includes/efetiv.php';
$item = new Relatorios("id556", "Efetivos", $tbl_efet);
$itens [] = $item;


$tbl_disc1 = '';
include __DIR__.'/includes/disp1.php';
$item = new Relatorios("id5", "Professores distribuidos por disciplinas", $tbl_disc1);
$itens [] = $item;

$tbl_prof = '';
include __DIR__.'/includes/profs.php';
$item = new Relatorios("id6", "Quadro de professores do colegiado", $tbl_prof);
$itens [] = $item;

$tbl_pad22 = '';
include __DIR__.'/includes/pad22.php';
$item = new Relatorios("id7", "Atividades de Supervisão e Orientação dos Professores do colegiado", $tbl_pad22);
$itens [] = $item;

$tbl_resumo = '';
include __DIR__.'/includes/relatorio.php';
$item = new Relatorios("id8", "Resumo por curso - Colegiado de", $tbl_resumo);
$itens [] = $item;

//********************* */
$tbl_profes = '';
include __DIR__.'/includes/profes.php';
$item = new Relatorios("id9", "Disciplinas do colegiado de", $tbl_profes);
$itens [] = $item;

$tbl_atvgest = '';
include __DIR__.'/includes/atvgest.php';
$item = new Relatorios("id10", "Atividades de Gestão Institucional", $tbl_atvgest);
$itens [] = $item;


$tbl_dispnoprof = '';
include __DIR__.'/includes/dispnoprof.php';
$item = new Relatorios("id11", "Disciplinas sem professores", $tbl_dispnoprof);
$itens [] = $item;


$tbl_projmonit = '';
include __DIR__.'/includes/projmonit.php';
$item = new Relatorios("id12", "Projetos de ensino e monitoria", $tbl_projmonit);
$itens [] = $item;



include '../includes/header.php';
include __DIR__.'/includes/content2.php';
include '../includes/footer.php';
   
   