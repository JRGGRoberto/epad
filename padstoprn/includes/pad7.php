<h5>Aprovação e Homologação</h5>

<table class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th class="align-top">Aprovação no Colegiado de Curso</th>    
        </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php
        if($vinc->aprov_co_id == null){
          echo 'Ainda não aprovado.';
        } else {
          echo '<p>Aprovado no Colegiado do Curso em ' . $vinc->aprov_co_data .'</p>';
          echo '<p>Aprovado no sistema pelo(a) Docente '. $vinc->assing_co.', Coordenador do Colegiado</p>';
        }
        ?>
        </td>
      </tr>
    </tbody>
</table>

<table class="table table-bordered table-sm">
    <thead class="thead-light">
        <tr>
            <th class="align-top">Homologado no Conselho de Centro</th>    
        </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php
        if($vinc->aprov_co_id == null){
          echo 'Necessita primeiro da aprovação do colegiado';
        } else {
          if($vinc->aprov_ce_id == null){
            echo 'Ainda não homologado.';
          } else {
            echo '<p>Homologado no Conselho de Centro em ' . $vinc->aprov_ce_data .'</p>';
            echo '<p>Aprovado pelo sistema pelo(a) Docente '. $vinc->assing_ce.'</p>';
          }
        }
        ?></td>
      </tr>
    </tbody>
</table>