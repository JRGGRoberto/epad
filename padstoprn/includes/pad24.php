<?php
// print_r($pad24);
?>
<h5>2.4. Afastamento</h5>

<table class="table table-bordered table-sm">
<thead class="thead-light">
        <tr>
            <th class="align-top" style="text-align: center;" width="178px">Modalidade</th>
            <th class="align-top">Tipo</th>
            <th class="align-top">Portaria</th>
            <th class="align-top"  width="75px">CH</th>
            <th class="align-top" style="text-align: center;" width="120px">Início</th>
            <th class="align-top" style="text-align: center;" width="120px">Fim</th>
        </tr>
    </thead>
    <tbody>
<?php
$total24 = 0;

function formaData($dt)
{
    return substr($dt, 8, 2).'/'.substr($dt, 5, 2).'/'.substr($dt, 0, 4);
}

function modal($mo)
{
    switch ($mo) {
        case '10':
            return 'Médico';
            break;
        case '20':
            return 'Doutorado';
            break;
        case '21':
            return 'Mestrado';
            break;
        case '22':
            return 'Pós-Doutorado';
            break;
    }
}

function tipo1($t)
{
    switch ($t) {
        case 't':
            return 'Total';
            break;
        case 'p':
            return 'Parcial';
            break;
    }
}

foreach ($pad24 as $p) {
    $total24 += $p->ch;
    echo "<tr>
    <td style='text-align: left;'>".modal($p->modalidade)."</td>
    <td style='text-align: left;'>".tipo1($p->tipo).'</td>
    <td>'.$p->portaria."</td>
    <td style='text-align: center;'>".$p->ch."</td>
    <td style='text-align: center;'>".formaData($p->dt_inicio)."</td>
    <td style='text-align: center;'>".formaData($p->dt_fim).'</td>
  </tr>
  ';
}
?>
        <tr>
         <td colspan="5" style='text-align: right;'>MÉDIA SEMANAL ANUAL DA CARGA HORÁRIA DE AFASTAMENTO</td>
         <td colspan="1" style='text-align: center;'><?php echo $total24; ?></td>
       </tr>
    </tbody>
</table>
