<?php

$sql = "
select * 
FROM pad22v p 
where 
   p.co_idvinc_orientador  = '". $user['co_id'] ."'
order by orientador, estudante, curso, serie";

$registros = Outros::qry($sql);
$tbl_pad22 .= '<table class="table table-bordered table-sm">
<thead class="thead-light">
    <tr>
        <th class="align-top">Atv.</th>
        <th class="align-top">Orientador(a)</th>
        <th class="align-top">Estudante</th>
        <th class="align-top">Série</th>
        <th class="align-top">Ch</th>
    </tr>
</thead>
<tbody>';
$qnt = 0;
foreach($registros as $reg){
    $tbl_pad22 .= "<tr>
                    <td>" . $reg->atividade . "</td>
                    <td>" . $reg->orientador . "</td>
                    <td>" . $reg->estudante . "<br><sub>" .  $reg->curso . "</sub></td>
                    <td>" . $reg->serie . "</td>
                    <td>" . $reg->ch . "</td>
                </tr>" ;
}
$tbl_pad22 .= '</tbody></table>
<sub style="line-height: 12px;"><strong>a</strong>) Estágio Curricular Supervisionado Obrigatório para os cursos de Graduação e Estágio Docência para Pós-graduação Stricto Sensu. ; 
<strong>b</strong>) Atividades de aulas práticas em
instituições da área de saúde; <strong>c</strong>) Orientação de Trabalhos Acadêmicos Obrigatórios (TCCs, dissertações e teses); <strong>d</strong>)
Orientação de Monitoria.</sub>
';