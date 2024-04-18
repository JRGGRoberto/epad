<?php

$tbl_contrads = '<h5>Quadro de professores atual do meu colegiado</h5>';
include __DIR__.'/includes/quad_prof.php';

$tbl_rt = "<h5>Distribuição de RT no colegiado de ".  $col_nome  ."</h5>";
include __DIR__.'/includes/rt.php';

$tbl_matriz = "<h5>Matriz(es) do curso ".  $col_nome  ." - ".  $camp_nome  ."/".  $centro_nome . "</h5>";
include __DIR__.'/includes/matriz.php';

$tbl_disc = "<h5>Matriz(es)/Disciplinas do curso" .  $col_nome ." - ".  $camp_nome ."/".  $centro_nome ."</h5>";
include __DIR__.'/includes/disp.php';

$tbl_disc1 = "<h5>Professores distribuidos por disciplinas" .  $col_nome  ." - ".  $camp_nome  ."/".  $centro_nome ."</h5>";
include __DIR__.'/includes/disp1.php';

$tbl_prof = "<h5>Quadro de professores do colegiado" .  $col_nome  ." - ".  $camp_nome  ."/".  $centro_nome ."</h5>";
include __DIR__.'/includes/profs.php';

$tbl_pad22 = "<h5>Atividades de Supervisão e Orientação dos Professores do colegiado" . $col_nome  ." - ".  $camp_nome  ."/".  $centro_nome ."</h5>";
include __DIR__.'/includes/pad22.php';

$tbl_resumo = "<h5>Resumo por curso - Colegiado de" .$col_nome. "em" .$camp_nome. "</h5>";
include __DIR__.'/includes/relatorio.php';

$tbl_profes = "<h5> Disciplinas do colegiado de" . $col_nome. "</h5>";
include __DIR__.'/includes/profes.php';


include '../includes/header.php';
include __DIR__.'/includes/content.php';
include '../includes/footer.php';
   
   