<?php

require '../vendor/autoload.php';
use \App\Entity\Outros;

$sql = "select * from matriz_v mv where id_curso = '". $co_id."' and mv.ano = ".$ano."";
$registros = Outros::qry($sql);
$tbl_matriz .= '<table class="table table-bordered table-sm">
<thead class="thead-light">
    <tr>
        <th class="align-top">n#</th>
        <th class="align-top">Matriz</th>
    </tr>
</thead>
<tbody>';
$qnt = 0;
foreach($registros as $reg){
    $tbl_matriz .= "<tr><td>" . ++$qnt . "</td><td>" . $reg->nome . " - [". $reg->ano ."]</td></tr>" ;
}
$tbl_matriz .= '</tbody></table><hr>';