<?php
require '../vendor/autoload.php';
use \App\Entity\Outros;

//--
$sql = 
"
select  
  CONCAT(
    CASE WHEN p.cat_func = 'c' THEN 't' ELSE p.cat_func END, 
    v.rt
   ) AS camp, 
   p.cat_func cfunc,  v.rt
from 
   vinculov v inner join 
   professores p on p.id = v.id_prof 
where 
  p.id_colegiado  = '". $co_id."'
  and v.ano = ".$ano."
group by 1;";

$registros = Outros::qry($sql);

$tbl_resumo .= '<table class="table table-bordered table-sm" id="relat">
<thead class="thead-light">
    <tr><th>Atividade</th>';
foreach($registros as $h){
    $tbl_resumo .= ' <th class="align-top"> '. $h->camp . '</th>';
}
$tbl_resumo .= '<th>Total</th>
</tr>
</thead>
<tbody>';

//--

$arratv1 = [];
$arratv2 = [];
$arratv3 = [];
$arratv4 = [];
$arratv5 = [];

//--
$tbl_resumo .='<tr>  <td> 1. Total de média semanal anual de carga horária didática </td>';
$sum1 = 0;
foreach($registros as $b1){
    $sql = "select  
        TRUNCATE(ifnull( sum(p21.cargah), 0),2) as ta21
    from 
    vinculov v 
        INNER join professores p on p.id = v.id_prof 
        INNER join pad21 p21 on p21.vinculo = v.id
    where 
        p.id_colegiado  =  '". $co_id."'
        and p.cat_func = '".  $b1->cfunc  ."'
        and v.rt = '".  $b1->rt  ."'";

    $rest1 = Outros::qry($sql);   
    foreach ($rest1 as $r) {
        $tbl_resumo .= '<td>'. $r->ta21 . '</td>';
        $arratv1[] = $r->ta21;
        $sum1 +=  $r->ta21;
    }
} 
$tbl_resumo .= '<td>'. number_format($sum1,2) . '</td>';

//--------------------------------------------------------------------------------------------------------
$tbl_resumo .='</tr><tr> <td>2.Total de média semanal anual de carga horária supervisão e orientação</td>';
$sum2 = 0;
foreach($registros as $b2){
    $sql = "select  
        TRUNCATE(ifnull( sum(p22.ch), 0),2) as ta22
    from 
    vinculov v 
        INNER join professores p on p.id = v.id_prof 
        INNER join pad22 p22 on p22.vinculo = v.id
    where 
        p.id_colegiado  =  '". $co_id."'
        and p.cat_func = '".  $b2->cfunc  ."'
        and v.rt = '".  $b2->rt  ."';";

    $rest2 = Outros::qry($sql);
    foreach ($rest2 as $r) {
        $tbl_resumo .= '<td>'. $r->ta22 . '</td>';
        $arratv2[] = $r->ta22;
        $sum2 +=  $r->ta22;
    }
}
$tbl_resumo .= '<td>'. number_format($sum2,2) . '</td>';
//--
$tbl_resumo .='</tr><tr> <td>3. Projetos de ensino e Monitoria</td>';
$sum3 = 0;
foreach($registros as $b3){
    $sql = "select  
        TRUNCATE(ifnull( sum(p23.ch), 0),2) as ta23
    from 
    vinculov v 
        INNER join professores p on p.id = v.id_prof 
        INNER join pad23 p23 on p23.vinculo = v.id
    where 
        p.id_colegiado  =  '". $co_id."'
        and p.cat_func = '".  $b3->cfunc  ."'
        and v.rt = '".  $b3->rt  ."';";

    $rest3 = Outros::qry($sql);
    foreach ($rest3 as $r) {
        $tbl_resumo .= '<td>'. $r->ta23 . '</td>';
        $arratv3[] = $r->ta23;
        $sum3 +=  $r->ta23;
    }
}
$tbl_resumo .= '<td>'. number_format($sum3,2) . '</td>';
//--
$tbl_resumo .='</tr><tr> <td>4. Total de carga horária semanal pesquisa/extensão/cultura/programas especiais</td>';
$sum4 = 0;
foreach($registros  as $b4){
    $sql = "select  
        TRUNCATE(ifnull( sum(p3.ch), 0),2) as ta3
    from 
    vinculov v 
        INNER join professores p on p.id = v.id_prof 
        INNER join pad3 p3 on p3.vinculo = v.id
    where 
        p.id_colegiado  =  '". $co_id."'
        and p.cat_func = '".  $b4->cfunc  ."'
        and v.rt = '".  $b4->rt  ."';";

    $rest4 = Outros::qry($sql);
    foreach ($rest4 as $r) {
        $tbl_resumo .= '<td>'. $r->ta3 . '</td>';
        $arratv4[] = $r->ta3;
        $sum4 +=  $r->ta3;
    }
}
$tbl_resumo .= '<td>'. number_format($sum4,2) . '</td>';
//--
$tbl_resumo .='</tr><tr> <td>5. Total de carga horária semanal de gestão institucional</td>';
$sum5 = 0;
foreach($registros as $b5){
    $sql = "select  
        TRUNCATE(ifnull( sum(p4.ch), 0),2) as ta4
    from 
    vinculov v 
        INNER join professores p on p.id = v.id_prof 
        INNER join pad4 p4 on p4.vinculo = v.id
    where 
        p.id_colegiado  =  '". $co_id."'
        and p.cat_func = '".  $b5->cfunc  ."'
        and v.rt = '".  $b5->rt  ."';";

    $rest5 = Outros::qry($sql);
    foreach ($rest5 as $r) {
        $tbl_resumo .= '<td>'. $r->ta4 . '</td>';
        $arratv5[] = $r->ta4;
        $sum5 +=  $r->ta4;
    }
}
$tbl_resumo .= '<td>'. number_format($sum5,2) . '</td>';
//--
$tbl_resumo .='</tr><tr> <td> Total </td>';

for($x = 0; $x < count($arratv1)  ; $x++){
    $tbl_resumo .= '<td>'.number_format(( $arratv1[$x] + $arratv2[$x] +  $arratv3[$x] + $arratv4[$x] +  $arratv5[$x] ),2). '</td>';
}
$somatot = ($sum1 + $sum2 + $sum3 + $sum4 + $sum5);
$tbl_resumo .= '<td>'. number_format($somatot, 2 ). '</td>';
$tbl_resumo .= '</td>';

$tbl_resumo .= '</tbody></table><button class="btn btn-light btn-sm" onclick="exportToExcel(\'relat\')">📊</button>

<sub style="line-height: 12px;">
Legenda para a tabela "7. Resumo por curso":
<br>
<strong>e</strong> - Efetivo.
<br>
<strong>t</strong> - Temporário.
</sub><hr>';

//--