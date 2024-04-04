<?php

require '../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();
use \App\Entity\Outros;

$tbl_contrads = '<h5>Quadro de professores atual do meu colegiado</h5>';
include __DIR__.'/includes/quad_prof.php';

$tbl_rt = "<h5>Distribuição de RT no colegiado de ".  $user['co_nome']  ."</h5>";
include __DIR__.'/includes/rt.php';


$tbl_matriz = "<h5>Matriz(es) do curso ".  $user['co_nome']  ." - ".  $user['lota_nome']  ."/".  $user['ce_cod']  . "</h5>";
include __DIR__.'/includes/matriz.php';




// =================
$sql = "select 
   m.nome as matriz, 
   m.turno, 
   d.nome as disc,
   d.professor as professor,
   d.colegiado as colegiado,
   d.serie as serie
from 
  matriz_v m 
  inner join disciplinasv d on m.id = d.id_matriz 
where m.id_curso = '". $user['co_id'] ."'
order by 
   6, 3";

$registros = Outros::qry($sql);
$tbl_disc = '<table class="table table-bordered table-sm">
<thead class="thead-light">
    <tr>
        <th class="align-top">Série</th>
        <th class="align-top">Disciplinas</th>
        <th class="align-top">Professor</th>
    </tr>
</thead>
<tbody>';
$qnt = 0;
foreach($registros as $reg){
    $tbl_disc .=
        "<tr>
            <td>" . $reg->serie ."</td>
            <td>" . $reg->disc ."</td>
            <td>" . $reg->professor ."<br><sub>" .  $reg->colegiado . "</sub></td>
        </tr>" ;
}
$tbl_disc .= '</tbody></table>';

// =================



$sql = "
select 
  v.nome professor,   
  CONCAT( if(p.cat_func = 'c' , 'CRES', 'Efet'), ' ', v.rt) as vinculo,
  d.nome as disciplina, d.serie,
  d.ch cha, h.horaexp chs,
  ccc.colegiado, CONCAT(UPPER(ccc.codcam), '/',ccc.codcentro ) loc  
from 
  vinculov v
  inner join professores p on p.id  = v.id_prof
  left join disciplinas d on d.vinculo  = v.id
  left join matriz_disc m on m.id = d.id_matriz
  left join  ca_ce_co ccc on m.id_curso = ccc.co_id
  left join horas h on h.horamatz = d.ch
where 
  v.co_id = '". $user['co_id'] ."'
order by v.nome, d.nome, ccc.colegiado, d.serie  ";

$registros = Outros::qry($sql);
$tbl_disc1 = '<table class="table table-bordered table-sm">
<thead class="thead-light">
    <tr>
        <th class="align-top">Professor</th>
        <th class="align-top">Vínculo</th>
        <th class="align-top">Disciplina</th>
        <th class="align-top">Série</th>
        <th class="align-top">Carga h</th>
    </tr>
</thead>
<tbody>';
$qnt = 0;
foreach($registros as $reg){
    $tbl_disc1 .=
        "<tr>
            <td>" . $reg->professor ."</td>
            <td>" . $reg->vinculo ."</td>
            <td>" . $reg->disciplina ."<br><sub>" .  $reg->colegiado . " - ". $reg->loc. "</sub></td>
            <td>" . $reg->serie ."</td>
            <td>" . $reg->cha ."<sub>anual</sub> / " . $reg->chs ."h<sub>sem</sub> </td>
        </tr>" ;
}
$tbl_disc1 .= '</tbody></table>';

// =================

$sql = "
select v.nome,  if(v.rt <> 'TIDE', concat('T', v.rt ), rt ) rt, if(p.cat_func='c','cres','efetivos') contrato
from 
  vinculov v
  inner join professores p on v.id_prof = p.id 
where p.id_colegiado ='". $user['co_id'] ."'
order BY 1, 3 ";

$registros = Outros::qry($sql);
$tbl_prof = '<table class="table table-bordered table-sm">
<thead class="thead-light">
    <tr>
        <th class="align-top">Professor(a)</th>
        <th class="align-top">Regime de Trabalho</th>
        <th class="align-top">Vínculo</th>
    </tr>
</thead>
<tbody>';
$qnt = 0;
foreach($registros as $reg){
    $tbl_prof .= "<tr>
                    <td>" . $reg->nome . "</td>
                    <td>" . $reg->rt . "</td>
                    <td>" . $reg->contrato . "</td>
                </tr>" ;
}
$tbl_prof .= '</tbody></table>';
 // =================


$tbl_pad22 = "<h5>Atividades de Supervisão e Orientação dos Professores do colegiado" . $user['co_nome']  ." - ".  $user['lota_nome']  ."/".  $user['ce_cod']  ."</h5>";
include __DIR__.'/includes/pad22.php';

include '../includes/header.php';
include __DIR__.'/includes/content.php';
include '../includes/footer.php';
   
   