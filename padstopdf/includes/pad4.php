<?php
// print_r($pad4);
?>
<h5>4. Atividades de Gestão Institucional</h5>
<table class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th class="align-top">Cargo</th>
            <th class="align-top">Local</th>
            <th class="align-top">Número e data Ato Legal</th>
            <th class="align-top" class="align-top" style="text-align: center;" width="140px" >Carga horária</th>          
        </tr>
    </thead>
    <tbody>
    <?php
$total4 = 0;
foreach($pad4 as $p){
  $total4 += $p->ch;
  echo "<tr>
  <td style='text-align: left;'>". $p->cargo ."</td>
  <td style='text-align: left;'>". $p->alocado ."</td>
  <td>". $p->numdata ."</td>
  <td style='text-align: center;'>". $p->ch ."</td>
</tr>
  ";
}
?>
       <tr>
         <td colspan="3" style='text-align: right;'>TOTAL DE CARGA HORÁRIA SEMANAL DE GESTÃO INSTITUCIONAL</td>
         <td colspan="1" style='text-align: center;'><?= $total3 ?></td>
       </tr>
    </tbody>
</table>