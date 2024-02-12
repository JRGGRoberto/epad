<?php
// print_r($pad4);
?>
<h2>4. Atividades de Gestão Institucional</h2>
<table class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th class="align-top">Cargo</th>
            <th class="align-top">Local</th>
            <th class="align-top">Número e data Ato Legal</th>
            <th class="align-top" class="align-top" style="text-align: center;" width="140px" >Carga horária<br><sup>semanal</sup></th>          
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
    </tbody>
</table>