<?php

require '../vendor/autoload.php';
use \App\Entity\Outros;
use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();


$co_id = $_GET["id"];

$sql = "select campus, codcentro, co_id , colegiado
from ca_ce_co ccc 
WHERE  co_id = '".$co_id  ."'
order by campus, colegiado ";


$q = Outros::q($sql);

$col_nome    = $q->colegiado;
$camp_nome   = $q->campus;
$centro_nome = $q->codcentro;

$count = 1;


class ItensRelatorio {
    public $id;
    public $titulo;
    public $tabela;

     public function __construct($id, $titulo, $tabela) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->tabela = $tabela;
    }
}
$ListaRelat = array();


$Item = new ItensRelatorio("id1", "Quadro de professores atual do meu colegiado", "a");
$ListaRelat[] = $Item;

$Item = new ItensRelatorio("id1", "Distribuição de RT no colegiado de", "b");
$ListaRelat[] = $Item;

foreach($ListaRelat as $r){
    echo $r->$titulo.'<br>';
}




$tbl_contrads = '<h5  id="id1" >'. $count++. '. Quadro de professores atual do meu colegiado</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/quad_prof.php';

$tbl_rt = '<h5  id="id2" >'. $count++. '. Distribuição de RT no colegiado de '.  $col_nome  .'</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/rt.php';

$tbl_matriz = '<h5  id="id3" >'. $count++. '. Matriz(es) do curso '.  $col_nome  .' - '.  $camp_nome  .'/'.  $centro_nome . '</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/matriz.php';

//$tbl_disc = '<h5  id="id4" >Matriz(es)/Disciplinas do curso ' .  $col_nome .' - '.  $camp_nome .'/'.  $centro_nome .'</h5><a href="#voltar">Voltar</a>';
//include __DIR__.'/includes/disp.php';

$tbl_disc1 = '<h5  id="id5" >'. $count++. '. Professores distribuidos por disciplinas ' .  $col_nome  .' - '.  $camp_nome  .'/'.  $centro_nome .'</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/disp1.php';

$tbl_prof = '<h5  id="id6" >'. $count++. '. Quadro de professores do colegiado ' .  $col_nome  .' - '.  $camp_nome  .'/'.  $centro_nome .'</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/profs.php';

$tbl_pad22 = '<h5  id="id7" >'. $count++. '. Atividades de Supervisão e Orientação dos Professores do colegiado ' . $col_nome  .' - '.  $camp_nome  .'/'.  $centro_nome .'</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/pad22.php';

$tbl_resumo = '<h5  id="id8" >'. $count++. '. Resumo por curso - Colegiado de ' .$col_nome. ' em ' .$camp_nome. '</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/relatorio.php';

$tbl_profes = '<h5  id="id9" >'. $count++. '.  Disciplinas do colegiado de ' . $col_nome. '</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/profes.php';

$tbl_atvgest = '<h5  id="id10" >'. $count++. '.  Atividades de Gestão Institucional </h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/atvgest.php';

$tbl_dispnoprof= '<h5  id="id11" >'. $count++. '.  Disciplinas sem professores </h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/dispnoprof.php';

$tbl_projmonit= '<h5  id="id12" >'. $count++. '. Projetos de ensino e monitoria </h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/projmonit.php';


include '../includes/header.php';
include __DIR__.'/includes/content.php';
include '../includes/footer.php';
   
   