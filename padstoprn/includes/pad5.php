<h5>5. Resumo das atividades e totalização</h5>
<table class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th class="align-top">Atividade</th>
            <th class="align-top">Carga horária semanal</th>         
        </tr>
    </thead>
    <tbody>
      <tr>
        <td>1. Total de média semanal anual de carga horária didática</td>
        <td style='text-align: right;'><?= $total21 ?></td>
      </tr>
      <tr>
        <td>2. Total de média semanal anual de carga horária supervisão e orientação</td>
        <td style='text-align: right;'><?= $total22 ?></td>
      </tr>
      <tr>
        <td>3. Total de carga horária semanal pesquisa/extensão/cultura/programas especiais</td>
        <td style='text-align: right;'><?= $total3 ?></td>
      </tr>
      <tr>
        <td>4. Total de carga horária semanal de gestão institucional</td>
        <td style='text-align: right;'><?= $total4 ?></td>
      </tr>
      <tr>
        <td>Total de carga horária semanal</td>
        <td style='text-align: right;'><?= $total21 + $total22 + $total3 + $total4 ?></td>
      </tr>
    </tbody>
</table>