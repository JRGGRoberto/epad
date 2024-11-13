<?php
// print_r($pad23);
?>
<h5>2.4. Afastamento</h5>

<table class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th class="align-top" style="text-align: left;" >Atividade</th>
            <th class="align-top" >Nome do projeto / curso</th>
            <th class="align-top" style="text-align: center;" width="75px">CH</th>
        </tr>
    </thead>
    <tbody>
<?php
$total23 = 0;

foreach($pad23 as $p){
  $total23 += $p->ch;
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
         <td colspan="2" style='text-align: right;'>MÉDIA SEMANAL ANUAL DA CARGA HORÁRIA DE ORIENTAÇÃO E SUPERVISÃO</td>
         <td colspan="1" style='text-align: center;'><?= $total23 ?></td>
       </tr>
    </tbody>
</table>
