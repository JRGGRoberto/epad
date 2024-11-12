<?php

require '../vendor/autoload.php';
use \App\Entity\Outros;

$sql = "
select 
  v.nome,  
  if(v.rt <> 'TIDE', concat('T', v.rt ), v.rt ) rt, 
  if(p.cat_func='c','cres','efetivos') contrato,
  CASE
    WHEN if(v.rt = 'TIDE', 40, v.rt) >  (ps.a21 +  ps.a22 + ps.a23 + ps.a3 +  ps.a4) THEN '>'
    WHEN if(v.rt = 'TIDE', 40, v.rt) <  (ps.a21 +  ps.a22 + ps.a23 + ps.a3 +  ps.a4) THEN '<'
    ELSE '='
  END as 'rt_uso',
  (ps.a21 +  ps.a22 + ps.a23 + ps.a3 +  ps.a4) som,
 if( LENGTH(ps.assing_co) > 5, 1, 0) co,
 if( LENGTH(ps.assing_ce) > 5, 1, 0) ce
  
from 
  vinculov v
  inner join pad_sucinto ps  on ps.id  = v.id  
  inner join professores p on v.id_prof = p.id 
where p.id_colegiado = '". $co_id."' and v.ano = ".$ano."
  order BY nome, contrato ";

$registros = Outros::qry($sql);
$tbl_prof .= '<table class="table table-bordered table-sm" id="profs">
<thead class="thead-light">
    <tr>
        <th class="align-top">Professor(a)</th>
        <th class="align-top">Reg. Trab.</th>
        <th class="align-top">RT Usado</th>
        <th class="align-top">Temp Usado</th>
        <th class="align-top">Vínculo</th>
        <th class="align-top">Assing CO</th>
        <th class="align-top">Assing CE</th>
    </tr>
</thead>
<tbody>'; 
$qnt = 0;
foreach($registros as $reg){
    $tbl_prof .= "<tr>
                    <td>" . $reg->nome . "</td>
                    <td>" . $reg->rt . "</td>
                    <td style='text-align: center;'>" . $reg->rt_uso . "</td>
                    <td style='text-align: center;'>" . $reg->som . "</td>
                    <td>" . $reg->contrato . "</td>
                    <td style='text-align: center;'>" . $reg->co . "</td>
                    <td style='text-align: center;'>" . $reg->ce . "</td>
                </tr>" ;
}
$tbl_prof .= '</tbody></table> 
                                <button class="btn btn-light btn-sm" onclick="exportToExcel(\'profs\')">📊</button>
                     <hr>';
                     