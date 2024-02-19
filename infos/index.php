<?php

require '../vendor/autoload.php';
use \App\Session\Login;
Login::requireLogin();
$user = Login::getUsuarioLogado();
use \App\Entity\Outros;


$sql = "
SELECT  
  if(cat_func='c','cres','efetivos') contrato,
  count(1) qnt,
  CONCAT(ROUND((COUNT(1) / (SELECT COUNT(1) FROM professores p2 where cat_func in ('c', 'e'))) * 100, 2), '%') AS percentual
 from professores p group by 1 order by 1 desc" ;
$registros = Outros::qry($sql);
$tbl_contrads = '<table class="table table-bordered table-sm">
<thead class="thead-light">
    <tr>
        <th class="align-top">Contrato</th>
        <th class="align-top">Quantidade</th>
        <th class="align-top">Percentual</th>
    </tr>
</thead>
<tbody>';
foreach($registros as $reg){
    $tbl_contrads .= "<tr><td>" . $reg->contrato . "</td><td>" . $reg->qnt . "</td><td>" . $reg->percentual . "</td></tr>" ;
}
$tbl_contrads .= '</tbody></table>';



$sql = "select if(rt <> 'TIDE', concat('T',rt ), rt ) rt, count(1) qnt from vinculov v  where campus = '". $user['lota_nome'] ."'  group by 1 order by 1";
$registros = Outros::qry($sql);
$tbl_rt = '<table class="table table-bordered table-sm">
<thead class="thead-light">
    <tr>
        <th class="align-top">Regime de trabalho</th>
        <th class="align-top">Quantidade de professores</th>
    </tr>
</thead>
<tbody>';
foreach($registros as $reg){
    $tbl_rt .= "<tr><td>" . $reg->rt . "</td><td>" . $reg->qnt . "</td></tr>" ;
}
$tbl_rt .= '</tbody></table>';


$sql = "select * from matriz_v mv where id_curso = '". $user['co_id'] ."'";
$registros = Outros::qry($sql);
$tbl_matriz = '<table class="table table-bordered table-sm">
<thead class="thead-light">
    <tr>
        <th class="align-top">n#</th>
        <th class="align-top">Matriz</th>
    </tr>
</thead>
<tbody>';
$qnt = 0;
foreach($registros as $reg){
    $tbl_matriz .= "<tr><td>" . ++$qnt . "</td><td>" . $reg->nome . "</td></tr>" ;
}
$tbl_matriz .= '</tbody></table>';



$sql = "select 
   m.nome as matriz, 
   m.turno, 
   d.nome as disc
from 
  matriz_v m 
  inner join disciplinasv d on m.id = d.id_matriz 
where m.id_curso = '". $user['co_id'] ."'";

$registros = Outros::qry($sql);
$tbl_disc = '<table class="table table-bordered table-sm">
<thead class="thead-light">
    <tr>
        <th class="align-top">Matriz</th>
        <th class="align-top">Disciplinas</th>
    </tr>
</thead>
<tbody>';
$qnt = 0;
foreach($registros as $reg){
    $tbl_disc .= "<tr><td>" . $reg->matriz . "</td><td>" . $reg->disc . "</td></tr>" ;
}
$tbl_disc .= '</tbody></table>';






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
        <th class="align-top">Tipo</th>
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







include '../includes/header.php';
include __DIR__.'/includes/content.php';
include '../includes/footer.php';
   
   