<?php

require '../vendor/autoload.php';
use \App\Entity\Outros;

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
  v.co_id = '". $co_id."' and v.ano = ".$ano."
order 
  by v.nome, d.nome, ccc.colegiado, d.serie  ";

$registros = Outros::qry($sql);
$tbl_disc1 .= '<table class="table table-bordered table-sm" id="disp1">
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
$tbl_disc1 .= '</tbody></table><button class="btn btn-light btn-sm" onclick="exportToExcel(\'disp1\')">📊</button><hr>';