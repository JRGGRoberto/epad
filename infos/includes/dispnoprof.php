<?php

require '../vendor/autoload.php';
use App\Entity\Outros;

$sql = " 
SELECT 
    mv.id_curso, d.nome as nome, d.serie as serie, d.vinculo, d.ch, h.horaexp 
FROM 
    disciplinas d 
    inner join matriz_v mv on d.id_matriz  = mv.id 
    left join horas h on d.ch = h.horamatz 
where
    (d.vinculo is null or d.vinculo = '' )
    and (mv.id_curso = '".$co_id."')
    and mv.ano = ".$ano.'
ORDER by 
    d.serie';

$registros = Outros::qry($sql);

$tbl_dispnoprof .= '<table class="table table-bordered table-sm" id="discSemProf01">
<thead class="thead-light">
    <tr>
        <th class="align-top">Disciplina</th>
        <th class="align-top">Série</th>
        <th class="align-top">Ch Semanal</th>
        <th class="align-top">Ch Anual</th>
    </tr>
</thead>
<tbody>';

$cnt = 0;
$bodytabele = '';
foreach ($registros as $reg) {
    $bodytabele .=
    '<tr>
       <td>'.$reg->nome.'</td>
       <td style="text-align: center;">'.$reg->serie.'</td>
       <td style="text-align: right;">'.$reg->horaexp.'</td>
       <td style="text-align: right;">'.$reg->ch.'</td>
    </tr>';
    $cnt = $cnt + 1;
}

if ($cnt >= 1) {
    $tbl_dispnoprof .= $bodytabele.'</tbody></table><button class="btn btn-light btn-sm" onclick="exportToExcel(\'discSemProf01\')">📊</button><hr>';
} elseif ($cnt == 0) {
    $bodytabele .= '
        <tr>
            <td colspan="4"> Não há nenhuma disciplna sem professor </td>
        </tr>';
    $tbl_dispnoprof .= $bodytabele.'</tbody></table><hr>';
}
