<?php

require '../vendor/autoload.php';
use \App\Entity\Outros;

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
$tbl_disc .= '<table class="table table-bordered table-sm">
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