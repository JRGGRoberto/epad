<?php 
require '../vendor/autoload.php';
use \App\Entity\Outros;

$sql = "
SELECT atividade, nome_atividade, ch 
FROM pad23v pv 
where id_co = '". $co_id."' and pv.ano = ".$ano." 
";
// aqui não tem nada

$registros = Outros::qry($sql);

$tbl_projmonit .= '<table class="table table-bordered table-sm" id="proj_monit">
<thead class="thead-light">
    <tr>
        <th class="align-top">Atividade</th>
        <th class="align-top">Nome</th>
        <th class="align-top">Carga horária </th>
    </tr>
</thead>
<tbody>';

$cnt=0;
$bodytabele = '';
foreach($registros as $reg){
    $bodytabele .= 
    "<tr><td>" . $reg->atividade . 
    "</td><td>" . $reg->nome_atividade .  
    "</td><td>" . $reg->ch . 
    "</td></tr>" ;
    $cnt=$cnt+1;
}

if ($cnt>=1) {
    $tbl_projmonit .= $bodytabele . '</tbody></table> 
                                <button class="btn btn-light btn-sm" onclick="exportToExcel(\'proj_monit\')">📊</button>
                     <hr>';
} elseif ($cnt==0) {
    $bodytabele .='
        <tr>
            <td colspan="2"> Não há nenhum projetos de ensino e monitoria  </td>
        </tr>';
    $tbl_projmonit .=$bodytabele .'</tbody></table><hr>';
} 