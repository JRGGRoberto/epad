<?php

require '../vendor/autoload.php';
use App\Entity\Outros;

$sql = "
select 
   ps.id, concat(UPPER(ca.codigo) ,' - ', co.nome ) colegiado,
   ps.nome,  
   a21, a22, a23, a24, a3, a4, 
   (ps.a21 + ps.a22 + ps.a23 + ps.a3 + ps.a4 ) tempo_usado, ps.rt
from 
   pad_sucinto ps
   inner join campi ca on ca.id  = ps.ca_id 
   inner join colegiados co on co.id  = ps.co_id 
where 
   co_id = '".$co_id."' and
   ano = '".$ano."' and
   ps.catf = 'd'
order by ps.nome
";

$registros = Outros::qry($sql);

$tbl_DispFunc .= '<table class="table table-bordered table-sm" id="atv_dispfunc">
<thead class="thead-light">
    <tr>
        <th class="align-top">Colegiado</th>
        <th class="align-top">Professor</th>
        <th style="text-align: center;">PAD</th>
        <th class="align-top">a21</th>
        <th class="align-top">a22</th>
        <th class="align-top">a23</th>
        <th class="align-top">a24</th>
        <th class="align-top">a3</th>
        <th class="align-top">a4</th>
        <th class="align-top">Total</th>
        <th class="align-top">RT</th>
    </tr>
</thead>
<tbody>';
foreach ($registros as $reg) {
    $tbl_DispFunc .=
    '<tr><td>'.$reg->colegiado.
    '</td><td>'.$reg->nome.
    '</td><td><a href="../padstoprn/index.php?id='.$reg->id.'" target="_blank">📄</a>'.
    '</td><td>'.$reg->a21.
    '</td><td>'.$reg->a22.
    '</td><td>'.$reg->a23.
    '</td><td>'.$reg->a24.
    '</td><td>'.$reg->a3.
    '</td><td>'.$reg->a4.
    '</td><td>'.$reg->tempo_usado.
    '</td><td>'.$reg->rt.
    '</td></tr>';
}
$tbl_DispFunc .= '</tbody></table><button class="btn btn-light btn-sm" onclick="exportToExcel(\'atv_dispfunc\')">📊</button><hr>';
