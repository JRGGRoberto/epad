<?php 
require '../vendor/autoload.php';
use \App\Entity\Outros;

$sql = " 
SELECT mv.id_curso, d.nome as nome, d.serie as serie, d.vinculo 
FROM disciplinas d 
inner join matriz_v mv on d.id_matriz  = mv.id 
where (d.vinculo is null or d.vinculo = '' )
and (mv.id_curso = '".$co_id."')
ORDER by d.serie";

$registros = Outros::qry($sql);

$tbl_dispnoprof .= '<table class="table table-bordered table-sm">
<thead class="thead-light">
    <tr>
        <th class="align-top">Disciplina</th>
        <th class="align-top">Série</th>
    </tr>
</thead>
<tbody>';

$cnt=0;
$bodytabele = '';
foreach($registros as $reg){
    $bodytabele .= 
    "<tr><td>" . $reg->nome . 
    "</td><td>" . $reg->serie . 
    "</td></tr>" ;
    $cnt=$cnt+1;
}

if ($cnt>=1) {
    $tbl_dispnoprof .= $bodytabele .'</tbody></table><hr>';
} elseif ($cnt==0) {
    $bodytabele .='
        <tr>
            <td colspan="2"> Não há nenhuma disciplna sem professor </td>
        </tr>';
    $tbl_dispnoprof .=$bodytabele .'</tbody></table><hr>';
} 





