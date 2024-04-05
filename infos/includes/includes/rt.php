<?php

require '../vendor/autoload.php';
use \App\Entity\Outros;

$sql = "select 
if(rt <> 'TIDE', concat('T',rt ), rt ) rt, count(1) qnt 
from vinculov v  
where v.co_id  = '". $co_id. "'
group by 1 order by 1
";

$registros = Outros::qry($sql);
$tbl_rt .= '<table class="table table-bordered table-sm">
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
$tbl_rt .= '</tbody></table><hr>';