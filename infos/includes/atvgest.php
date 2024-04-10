<?php 
require '../vendor/autoload.php';
use \App\Entity\Outros;

$sql = "
SELECT p.nome as nome, p2.cargo as cargo, v.campus as campus, p2.numdata as nd, p2.ch  as ch
from 
   professores p  
   inner join vinculov v on v.id_prof  = p.id 
   inner join pad4 p2 on p2.vinculo  = v.id 
where p.id_colegiado ='". $co_id."'
";

$registros = Outros::qry($sql);

$tbl_atvgest .= '<table class="table table-bordered table-sm" id="atvgest1">
<thead class="thead-light">
    <tr>
        <th class="align-top">Professor</th>
        <th class="align-top">Cargo</th>
        <th class="align-top">Local</th>
        <th class="align-top">Número e data ato legal</th>
        <th class="align-top">Carga horária semanal</th>
    </tr>
</thead>
<tbody>';
foreach($registros as $reg){
    $tbl_atvgest .= 
    "<tr><td>" . $reg->nome . 
    "</td><td>" . $reg->cargo . 
    "</td><td>" . $reg->campus . 
    "</td><td>" . $reg->nd . 
    "</td><td>" . $reg->ch . 
    "</td></tr>" ;
}
$tbl_atvgest .= '</tbody></table><button class="btn btn-light btn-sm" onclick="exportToExcel(\'atvgest1\')">📊</button><hr>';