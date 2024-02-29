<?php
// print_r($pad21);
?>
<h5>2.1. Atividades Didáticas</h4>

<table class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th class="align-top" style="text-align: center;" width="78px">Atividade</th>
            <th class="align-top">Disciplina</th>
            <th class="align-top">Curso</th>
            <th class="align-top" style="text-align: center;">Turno</th>
            <th class="align-top" style="text-align: center;" width="75px">CH </th>
        </tr>
    </thead>
    <tbody>
<?php
$total21 = 0;
foreach($pad21 as $p){
  $total21 += $p->cargah;
  switch($p->turno){
    case 'm':
      $turno = 'Matutino';
      break;
    case 'v':
      $turno = 'Vespertino';
      break;
    case 'n':
      $turno = 'Noturno';
      break;
    case 'i':
      $turno = 'Integral';
      break;
    default:
      $turno = '';
  };
  $ch1 = number_format($p->cargah, 0);
  if($p->atividade == 'd'){
    $atv = " (planejamento)";
  } else {
    $atv = "";
  }
  echo "<tr>
  <td style='text-align: center;'>". $p->atividade ."</td>
  <td>". $p->disciplina . $atv ."</td>
  <td>". $p->curso ."</td>
  <td style='text-align: center;'>". $turno ."</td>
  <td style='text-align: center;'>". $ch1 ."</td>
</tr>
  ";
}

?>
       <tr>
         <td colspan="4" style='text-align: right;'>MÉDIA SEMANAL ANUAL DA CARGA HORÁRIA DIDÁTICA</td>
         <td colspan="2" style='text-align: center;'><?= $total21 ?></td>
       </tr>
    </tbody>
</table>
<sup style="line-height: 12px;"><strong>a</strong>) Aulas na graduação; <strong>b</strong>) Aulas na pós-graduação Lato Sensu gratuita; <strong>c</strong>) Aulas na pós-graduação Stricto Sensu (estas devem ser computadas na razão de 1,5 hora/aula); <strong>d</strong>)
Planejamento didático-pedagógico.</sup>