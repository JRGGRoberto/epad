<?php 
require '../vendor/autoload.php';
use \App\Entity\Outros;

$sql = "
select 
  ccc.campus, ccc.colegiado, p.nome, v.rt,  
  (ps.a21 + ps.a22 + ps.a23 + ps.a3 + ps.a4 ) tempo_usado
from professores p 
inner join ca_ce_co ccc on p.id_colegiado  = ccc.co_id 
inner join vinculov v on v.id_prof = p.id 
inner join pad_sucinto ps on ps.id = v.id 
where p.cat_func = 'c' and p.id_colegiado ='". $co_id."'
order by 1, 2, 3
";

$registros = Outros::qry($sql);

$tbl_cres .= '<table class="table table-bordered table-sm" id="atv_cres">
<thead class="thead-light">
    <tr>
        <th class="align-top">Campus</th>
        <th class="align-top">Colegiano</th>
        <th class="align-top">Professor</th>
        <th class="align-top">RT</th>
        <th class="align-top">Tempo Usado</th>
    </tr>
</thead>
<tbody>';
foreach($registros as $reg){
    $tbl_cres .= 
    "<tr><td>" . $reg->campus . 
    "</td><td>" . $reg->colegiado . 
    "</td><td>" . $reg->nome . 
    "</td><td>" . $reg->rt . 
    "</td><td>" . $reg->tempo_usado . 
    "</td></tr>" ;
}
$tbl_cres .= '</tbody></table><button class="btn btn-light btn-sm" onclick="exportToExcel(\'atv_cres\')">📊</button><hr>';