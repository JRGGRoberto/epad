<?php 
require '../vendor/autoload.php';
use \App\Entity\Outros;

$sql = "
select d.nome as disciplina, d.ch, h.horaexp as chsemanal, d.serie, v.nome prof, v.colegiado 
from colegiados c 
  inner join matriz_disc md on md.id_curso  = c.id 
  inner join disciplinas d on d.id_matriz  = md.id 
  left join vinculov v on v.id = d.vinculo 
  left join horas h on h.horamatz = d.ch 
where c.id  = '". $co_id."' and v.ano = ".$ano."
ORDER BY serie, prof    ";
$registros = Outros::qry($sql);
$tbl_profes .= '<table class="table table-bordered table-sm" id="profess">
<thead class="thead-light">
    <tr>
        <th class="align-top">Colegiado</th>
        <th class="align-top">Disciplina</th>
        <th class="align-top">Professor</th>
        <th class="align-top">Série</th>
        <th class="align-top">Horas Semanais</th>
        <th class="align-top">Horas Anuais</th>
    </tr>
</thead>
<tbody>';
foreach($registros as $reg){
    $tbl_profes .= 
    "<tr><td>" . $reg->colegiado . "</td><td>" . $reg->disciplina . "</td><td>" . $reg->prof . "</td><td>" . $reg->serie . "</td><td>" . $reg->chsemanal . "</td><td>" . $reg->ch . "</td></tr>" ;
}
$tbl_profes .= '</tbody></table> 
<button class="btn btn-light btn-sm" onclick="exportToExcel(\'profess\')">📊</button>
<hr>';