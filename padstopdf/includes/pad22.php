<?php
// print_r($pad22);
?>
<h5>2.2. Atividades de Supervisão e Orientação</h5>

<table class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th class="align-top" style="text-align: center;" width="78px">Atividade</th>
            <th class="align-top" >Nome do(a) estudante</th>
            <th class="align-top" >Curso</th>
            <th class="align-top" style="text-align: center;" width="75px">Série</th>
            <th class="align-top" style="text-align: center;" width="75px">CH</th>
        </tr>
    </thead>
    <tbody>
<?php
$total22 = 0;
foreach($pad22 as $p){
  $total22 += $p->ch;
  echo "<tr>
  <td style='text-align: center;'>". $p->atividade ."</td>
  <td>". $p->estudante ."</td>
  <td>". $p->curso ."</td>
  <td style='text-align: center;'>". $p->serie ."</td>
  <td style='text-align: center;'>". $p->ch ."</td>
</tr>
  ";
}
?>
        <tr>
         <td colspan="4" style='text-align: right;'>MÉDIA SEMANAL ANUAL DA CARGA HORÁRIA DE ORIENTAÇÃO E SUPERVISÃO</td>
         <td colspan="2" style='text-align: center;'><?= $total22 ?></td>
       </tr>
    </tbody>
</table><sup style="line-height: 12px;"><strong>a</strong>) Estágio Curricular Supervisionado Obrigatório para os cursos de Graduação e Estágio Docência para Pós-graduação Stricto Sensu. ; 
<strong>b</strong>) Atividades de aulas práticas em
instituições da área de saúde; <strong>c</strong>) Orientação de Trabalhos Acadêmicos Obrigatórios (TCCs, dissertações e teses); <strong>d</strong>)
Orientação de Monitoria.</sup>
