<?php
// print_r($pad24);
?>
<h5>2.4. Afastamentos</h5>

<table class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th class="align-top" style="text-align: left;" >Modalidade</th>
            <th class="align-top" >Tipo</th>
            <th class="align-top" >Portaria</th>
            <th class="align-top" style="text-align: center;" width="75px">CH</th>
            <th class="align-top" >Início</th>
            <th class="align-top" >Fim</th>

        </tr>
    </thead>
    <tbody>
<?php
$total24 = 0;

foreach($pad24 as $p){
  $total24 += $p->ch;
  $txtAtv = '';
  switch ( $p->atividade) {
    case 1:
      $txtAtv = 'Projeto de ensino';
      break;
    case 2:
      $txtAtv = 'Monitoria';
      break;
  }



  echo "<tr>
  <td style='text-align: left;'>". $txtAtv ."</td>
  <td>". $p->nome_atividade ."</td>
  <td style='text-align: center;'>". $p->ch ."</td>
</tr>
  ";
}
?>
        <tr>
         <td colspan="2" style='text-align: right;'>MÉDIA SEMANAL ANUAL DA CARGA HORÁRIA DE AFASTAMENTOS</td>
         <td colspan="1" style='text-align: center;'><?= $total24 ?></td>
       </tr>
    </tbody>
</table>
