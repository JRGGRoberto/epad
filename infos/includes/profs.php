<?php

require '../vendor/autoload.php';
use \App\Entity\Outros;

$sql = "
select v.nome,  if(v.rt <> 'TIDE', concat('T', v.rt ), rt ) rt, if(p.cat_func='c','cres','efetivos') contrato
from 
  vinculov v
  inner join professores p on v.id_prof = p.id 
where p.id_colegiado ='". $user['co_id'] ."'
order BY 1, 3 ";

$registros = Outros::qry($sql);
$tbl_prof .= '<table class="table table-bordered table-sm">
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
$tbl_prof .= '</tbody></table><hr>';