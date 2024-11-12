<?php

require '../vendor/autoload.php';
use \App\Entity\Outros;

$sql = "
SELECT  
    if(cat_func='c','cres','efetivos') contrato,
    count(1) qnt,
    CONCAT(ROUND((COUNT(1) / 
       (
             SELECT COUNT(1) 
                 FROM professores p2
                 inner join vinculov v2 on v2.id_prof = p2.id
               where
                 p2.id_colegiado  = '". $co_id. "' and
                 cat_func in ('c', 'e') and 
                 v2.ano = ".$ano.")  
        ) * 100, 2), '%'
    ) AS percentual
 from 
    professores p
    inner join vinculo v on v.id_prof = p.id and v.ano = ".$ano." 
where 
   p.id_colegiado  = '". $co_id. "'
 group by 1 order by 1 desc;
" ;


$registros = Outros::qry($sql);

$tbl_contrads .= '
<table class="table table-bordered table-sm" id ="quad_f">
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
$tbl_contrads .= '</tbody></table> <button class="btn btn-light btn-sm" onclick="exportToExcel(\'quad_f\')">📊</button><hr>';

