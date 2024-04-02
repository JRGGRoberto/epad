<h5>3. Atividades de Pesquisa / Extensão / Cultura e Programas Especiais</h5>
<table class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th class="align-top">Atividades de Pesquisa,<br>Extensão e Cultura e Programas Especiais</th>
            <th class="align-top" style="text-align: center;">Função</th>
            <th class="align-top">Título</th>
            <th class="align-top">Nome do orientando(s)</th>
            <th class="align-top" style="text-align: center;">Carga horária</th>
        </tr>
    </thead>
    <tbody>
<?php
$total3 = 0;
foreach($pad3 as $p){
  $total3 += $p->ch;
  switch ($p->atividade) {
    case '1':
      $tipo = 'Pesquisa';
      break;
    case '2':
      $tipo = 'Extensão e cultura';
      break;
    case '3':
      $tipo = 'Outro - informar em observações';
      break;
    case '4':
       $tipo = 'PIC';
        break;
    case '5':
        $tipo = 'PIBEX';
        break;
    default:
      $tipo = 'Não definido';
  };

  $func ='';
  if((int)$p->funcao == 1){
    $func = 'Coordenador';
  } elseif ((int)$p->funcao == 2){
    $func = 'Membro';
  } elseif ((int)$p->funcao == 3){
    $func = 'Programas especiais';
  } else {
    $func = 'Não definido';
  }

  echo "<tr>
  <td style='text-align: left;'>". $tipo ."</td>
  <td style='text-align: center;'>". $func ."</td>
  <td >". $p->nome ."</td>
  <td>". $p->orientandos ."</td>
  <td style='text-align: center;'>". $p->ch ."</td>
</tr>
  ";
}
?>
       <tr>
         <td colspan="4" style='text-align: right;'>TOTAL DE CARGA HORÁRIA SEMANAL PESQUISA/EXTENSÃO/CULTURA/PROGRAMAS ESPECIAIS</td>
         <td colspan="1" style='text-align: center;'><?= $total3 ?></td>
       </tr>
    </tbody>
</table>