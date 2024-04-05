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

'<body>
<div id="voltar"></div>
<ol>
    <li><a href="#id1">Quadro de professores atual do meu colegiado</a></li>
    <li><a href="#id2">Distribuição de RT no colegiado de '.  $col_nome  .'</a></li>
    <li><a href="#id3">Matriz(es) do curso '.  $col_nome  .' - '.  $camp_nome  .'/'.  $centro_nome . '</a></li>
    <li><a href="#id4">Matriz(es)/Disciplinas do curso' .  $col_nome .' - '.  $camp_nome .'/'.  $centro_nome .'</a></li>
    <li><a href="#id5">Professores distribuidos por disciplinas' .  $col_nome  .' - '.  $camp_nome  .'/'.  $centro_nome .'</a></li>
    <li><a href="#id6">Quadro de professores do colegiado' .  $col_nome  .' - '.  $camp_nome  .'/'.  $centro_nome .'</a></li>
    <li><a href="#id7">Atividades de Supervisão e Orientação dos Professores do colegiado' . $col_nome  .' - '.  $camp_nome  .'/'.  $centro_nome .'</a></li>
    <li><a href="#id8">Resumo por curso - Colegiado de' .$col_nome. 'em' .$camp_nome. '</a></li>
    <li><a href="#id9"> Disciplinas do colegiado de' . $col_nome. '</a></li>
</ol>
</body>';

$tbl_contrads = '<h5  id="id1" >Quadro de professores atual do meu colegiado</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/quad_prof.php';

$tbl_rt = '<h5  id="id2" >Distribuição de RT no colegiado de '.  $col_nome  .'</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/rt.php';

$tbl_matriz = '<h5  id="id3" >Matriz(es) do curso '.  $col_nome  .' - '.  $camp_nome  .'/'.  $centro_nome . '</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/matriz.php';

$tbl_disc = '<h5  id="id4" >Matriz(es)/Disciplinas do curso' .  $col_nome .' - '.  $camp_nome .'/'.  $centro_nome .'</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/disp.php';

$tbl_disc1 = '<h5  id="id5" >Professores distribuidos por disciplinas' .  $col_nome  .' - '.  $camp_nome  .'/'.  $centro_nome .'</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/disp1.php';

$tbl_prof = '<h5  id="id6" >Quadro de professores do colegiado' .  $col_nome  .' - '.  $camp_nome  .'/'.  $centro_nome .'</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/profs.php';

$tbl_pad22 = '<h5  id="id7" >Atividades de Supervisão e Orientação dos Professores do colegiado' . $col_nome  .' - '.  $camp_nome  .'/'.  $centro_nome .'</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/pad22.php';

$tbl_resumo = '<h5  id="id8" >Resumo por curso - Colegiado de' .$col_nome. 'em' .$camp_nome. '</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/relatorio.php';

$tbl_profes = '<h5  id="id9" > Disciplinas do colegiado de' . $col_nome. '</h5><a href="#voltar">Voltar</a>';
include __DIR__.'/includes/profes.php';


include '../includes/header.php';
include __DIR__.'/includes/content.php';
include '../includes/footer.php';
   
   