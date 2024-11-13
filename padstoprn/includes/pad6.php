<h5>6. Outras observações</h5>
<table class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th class="align-top">Observações</th>    
        </tr>
    </thead>
    <tbody>
      <tr>
        <td><?= $vinc->obs ?></td>
      </tr>
    </tbody>
</table>

<table class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th class="align-top">Observações da coordenação</th>    
        </tr>
    </thead>
    <tbody>
      <tr>
        <td><?= $vinc->obscoord ?? '-' ?></td>
      </tr>
    </tbody>
</table>